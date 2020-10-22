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
            ], Response::HTTP_INTERNAL_SERVER_ERROR,);
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

    public function logout(Request $request)
    {
        try {
            JWTAuth::invalidate();
            return response()->success([
                'message' => 'You have successfully logged out.',
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->error([
                'message' => 'Failed to logout, please try again.',
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
