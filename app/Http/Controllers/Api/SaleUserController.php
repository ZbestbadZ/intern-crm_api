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
use App\Http\Requests\LoginRequest;
use App\Http\Requests\CheckTokenRequest;
use App\Http\Requests\FogotPasswordRequest;
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

    public function login(LoginRequest $request)
    {
        $attempt = Auth::guard('sale_user')->attempt(['email' => request('email'), 'password' => hash( 'sha256', request('password') )]);
        if ($attempt) {
            $user = Auth::guard('sale_user')->user();
            if (!empty($user->deleted_at)) {
                return response()->error('',__('message.login_fail'), Response::HTTP_UNPROCESSABLE_ENTITY);
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
                $profileSaleUser = Auth::user()->profile()->first();
                $avatarSaleUser = !empty($profileSaleUser) ? $profileSaleUser->avatar: '';
                $fullNameSaleUser = !empty($profileSaleUser) ? $profileSaleUser->full_name : '';
                return response()->success([
                    'token' => $token,
                    'avatar' => $avatarSaleUser,
                    'name' => $fullNameSaleUser,
                ], Response::HTTP_OK);
            }
        }
        return response()->error('',__('message.login_fail'), Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function create(SaleUserRequest $request)
    {
        $data = $request->all();
        try {
            $newUser = $this->repository->create($data['email'], $data['password']);
            if($newUser){
                return response()->success([
                    'message' => __('message.sale_user_create_success'),
                ]);
            }
        } catch (\Exception $e) {
            return response()->error($e->getMessage(),__('message.error_system'), Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    public function checkExpiration(CheckTokenRequest $request){
        $data = $request->all();

        if ($userId = $this->repository->verifyToken($data['token'])) {
            return response()->success([
                'message' => __('message.auth_code_ok'),
                'userId' => $userId,
            ], Response::HTTP_OK);
        }
        return response()->error('',__('message.auth_code_error'), Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function logout(Request $request)
    {
        try {
            auth('sale_user')->logout();
            return response()->success([
                'message' => __('message.logout_success'),
            ], Response::HTTP_OK);
        } catch (\Exception $e) {
            return response()->error($e->getMessage(),__('message.logout_fail'), Response::HTTP_BAD_REQUEST);
        }
    }

    public function forgotPassword(FogotPasswordRequest $request)
    {
        $emailResetPassUser = $request->get('email');
        $resetPassSaleUser = $this->repository->forgotPassword($emailResetPassUser);
        if($resetPassSaleUser){
            return response()->success([
                'message' =>  __('message.check_mail')
            ]);
        }
        return response()->error('',__('message.error_system'), Response::HTTP_INTERNAL_SERVER_ERROR);
    }

    public function verifyForgotPassword(CheckTokenRequest $request){
        $data = $request->all();

        $token = $data['token'];
        $authPurpose = Config::get('constants.auth_purpose');
        $verifyPassSaleUser = $this->repository->verifyForgotPassword($token, $authPurpose);
        
        if ($verifyPassSaleUser) {
            return response()->success([
                'message' =>  __('message.success_ok'),
            ], Response::HTTP_OK);
        }
        return response()->error('',__('message.error_token'), Response::HTTP_UNPROCESSABLE_ENTITY);
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
        return response()->error('',__('message.error_token'), Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    public function profile(Request $request){
        $infoSaleUser = Auth::user()->profile()->first();
        if(!empty($infoSaleUser)){
            return response()->success([
                'profile' => $infoSaleUser
            ], Response::HTTP_OK);
        }

        return response()->error('',__('message.profile_empty'), Response::HTTP_NOT_FOUND);
    }
}
