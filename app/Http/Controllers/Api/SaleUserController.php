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
    protected $_saleUser;

    public function __construct(
        SaleUserRepositoryInterface $saleUser
    )
    {
        $this->_saleUser = $saleUser;
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
                    'message' => 'The ID or password is different',
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
            'message' => 'The ID or password is different.',
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function create(SaleUserRequest $request)
    {
        $data = $request->all();
        try {
            $newUser = $this->_saleUser->create($data['email'], $data['password']);
            return response()->success([
                'message' => 'Create User Success'
            ]);
        } catch (\Exception $e) {
            return response()->error([
                'message' => 'A system error has occurred.'
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

        if ($userId = $this->_saleUser->verifyToken($data['token'])) {
            return response()->success([
                'message' => 'Success to Authenticate',
                'userId' => $userId,
            ], Response::HTTP_OK);
        }

        return response()->error([
            'message' => 'Failed to Authenticate'
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
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
        $resetPassSaleUser = $this->_saleUser->forgotPassword($emailResetPassUser);
        if($resetPassSaleUser){
            return response()->success([
                'message' => 'Check Mail'
            ]);
        }
        return response()->error([
            'message' => 'A system error has occurred.'
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
        $tokenData = EmailAuth::where('authcode', $token)->where('authpurpose', $authPurpose['forgot_password'])->first();

        if ($tokenData) {
            if (strtotime("now") > strtotime($tokenData->expiration_at)) {
                return response()->error([
                    'message' =>  'Token Error',
                ], Response::HTTP_UNPROCESSABLE_ENTITY,);
            }

            $saleUser = SaleUser::where('email', $tokenData->email)->where('is_auth', SaleUser::USER_AUTH)->first();
            if ($saleUser) {
                return response()->success([
                    'message' => 'OK',
                ], Response::HTTP_OK);
            }
        }
        return response()->error([
            'message' =>  'Token Error',
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function changeForgotPassword(SaleUserPasswordRequest $request){
        $password = $request->get('password');
        $token = $request->get('token');

        $authPurpose = Config::get('constants.auth_purpose');
        $tokenData = EmailAuth::where('authcode', $token)->where('authpurpose', $authPurpose['forgot_password'])->first();

        if ($tokenData) {
            if (strtotime("now") > strtotime($tokenData->expiration_at)) {
                return response()->error([
                    'message' =>  'Token Error',
                ], Response::HTTP_UNPROCESSABLE_ENTITY,);
            }

            $saleUser = SaleUser::where('email', $tokenData->email)->where('is_auth', SaleUser::USER_AUTH)->first();
            if ($saleUser) {
                $saleUser->password = hash('sha256', $password);
                $saleUser->save();
                // If the user shouldn't reuse the token later, delete the token
                EmailAuth::where('email', $saleUser->email)->where('authcode', $token)->where('authpurpose', $authPurpose['forgot_password'])->delete();
    
                return response()->success([
                    'message' => 'OK',
                ], Response::HTTP_OK);
            }
        }
        return response()->error([
            'message' =>  'Token Error',
        ], Response::HTTP_UNPROCESSABLE_ENTITY);
    }
}
