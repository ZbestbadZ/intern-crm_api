<?php

namespace App\Http\Controllers\Api;

use JWTAuth;
use Illuminate\Support\Facades\Config;
use App\Models\SaleUser;
use App\Models\EmailAuth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\SaleUserRequest;
use App\Http\Requests\SaleUserPasswordRequest;
use App\Repositories\SaleUser\SaleUserRepositoryInterface;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class SaleUserController extends Controller
{
    protected $repository;

    public function __construct(
        SaleUserRepositoryInterface $saleUser
    )
    {
        $this->repository = $saleUser;
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required',
            'password' => [
                'bail',
                'required',
                'min:8',
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ]
        ]);

        if ($validator->fails()) {
            return response()->error([
                $validator->errors(),
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $attempt = Auth::guard('sale_user')->attempt(['email' => request('email'), 'password' => hash( 'sha256', request('password') )]);
        if ($attempt) {
            $user = Auth::guard('sale_user')->user();
            if (!empty($user->deleted_at)) {
                return response()->error([
                    'message' => __('message.login_fail'),
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            }
            $statusUser = $user->is_active;
            if($statusUser){
                $payloadable = [
                    'id' => $user->id,
                    'email' => $user->email,
                    'role_id' => $user->role_id,
                    'is_active' => $user->is_active,
                ];
                $token = JWTAuth::customClaims($payloadable)->fromUser($user);
                return response()->success([
                    'token' => $token,
                ], Response::HTTP_OK);
            }
        }
        return response()->error([
            'message' => __('message.login_fail'),
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function create(SaleUserRequest $request)
    {
        $data = $request->all();
        try {
            $newUser = $this->repository->create($data['email'], $data['password']);
            return response()->success([
                'message' => __('message.sale_user_create_success')
            ]);
        } catch (\Exception $e) {
            return response()->error([
                'message' => __('message.error_system')
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function checkExpiration(Request $request){
        $data = $request->all();
        $validator = Validator::make($data, [
            'token'   => 'required'
        ],
        [
            'token.required' => 'Please enter the token.',
        ]
        );
        if ($validator->fails()) {
            return response()->error([
                'error' =>  $validator->errors(),
            ],Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if ($userId = $this->repository->verifyToken($data['token'])) {
            return response()->success([
                'message' => __('message.auth_code_ok'),
                'userId' => $userId,
            ], Response::HTTP_OK);
        }

        return response()->error([
            'message' => __('message.auth_code_error'),
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function logout(Request $request)
    {
        try {
            auth('sale_user')->logout();
            return response()->success([
                'message' => __('message.logout_success'),
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->error([
                'message' => __('message.logout_fail'),
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    public function forgotPassword(Request $request)
    {
        $messages = array(
            'email.required' => 'Email is required.',
            'email.max' => 'The :attribute may not be greater than :max characters.',
            'email.email' => 'The :attribute must be a valid email address.',
            'email.regex' => 'The :attribute format is invalid.',
        );
        $validator =  Validator::make($request->all(), [
            'email' => [
                'bail',
                'required',
                'max:191',
                'email',
                'regex:/(.*)@miichisoft\.(com|net)/i',
            ],
        ]);

        if ($validator->fails()) {
            return response()->error([
                $validator->errors()
            ], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $emailResetPassUser = $request->get('email');
        $resetPassSaleUser = $this->repository->forgotPassword($emailResetPassUser);
        if($resetPassSaleUser){
            return response()->success([
                'message' =>  __('message.check_mail')
            ]);
        }
        return response()->error([
            'message' =>  __('message.error_system')
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function verifyForgotPassword(Request $request){
        $data = $request->all();
        $validator = Validator::make($data, [
            'token'   => 'required'
        ],
        [
            'token.required' => 'The :attribute field is required.',
        ]
        );
        if ($validator->fails()) {
            return response()->error([
                $validator->errors(),
            ],Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $token = $data['token'];
        $authPurpose = Config::get('constants.auth_purpose');
        $verifyPassSaleUser = $this->repository->verifyForgotPassword($token, $authPurpose);
        
        if ($verifyPassSaleUser) {
            return response()->success([
                'message' =>  __('message.success_ok'),
            ], Response::HTTP_OK);
        }

        return response()->error([
            'message' =>  __('message.error_token')
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function changeForgotPassword(SaleUserPasswordRequest $request){
        $password = $request->get('password');
        $token = $request->get('token');
        $authPurpose = Config::get('constants.auth_purpose');
        $changeForgotPassword = $this->repository->changeForgotPassword($token, $password, $authPurpose);
        if ($changeForgotPassword) {
            return response()->success([
                'message' => __('message.success_ok'),
            ], Response::HTTP_OK);
        }
        return response()->error([
            'message' =>  __('message.error_token')
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function profile(Request $request){
        $infoSaleUser = Auth::user();
        $id = $infoSaleUser->id;
        $email = $infoSaleUser->email;
        $profileSaleUser = $this->repository->profile($id, $email);
        if(!empty($profileSaleUser)){
            return response()->success([
                'profileUser' => $profileSaleUser
            ], Response::HTTP_OK);
        }
        return response()->error([
            'message' => __('message.profile_empty'),
        ], Response::HTTP_NOT_FOUND);
    }
}
