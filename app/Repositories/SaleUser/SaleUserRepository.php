<?php

namespace App\Repositories\SaleUser;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use App\Models\SaleUser;
use App\Models\EmailAuth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use App\Repositories\EmailAuth\EmailAuthRepositoryInterface;
use Carbon\Carbon;
use App\Jobs\SendMailCreateSaleUser;
use App\Jobs\SendMailForgotPasswordSaleUser;
use App\Helpers\AppHelper;


class SaleUserRepository implements SaleUserRepositoryInterface
{
    CONST TEMP_ID = 0;
    protected $_emailAuth;

    public function __construct(EmailAuthRepositoryInterface $emailAuth)
    {
        $this->_emailAuth = $emailAuth;
    }

    public function create($email, $password) {
        $authPurpose = Config::get('constants.auth_purpose');
        $dataSendMail = [];

        $newUser = new SaleUser;
        $newUser->email = $email;
        $newUser->password = Str::random(50);
        $newUser->is_active = SaleUser::USER_INACTIVE;
        $newUser->role_id = SaleUser::ROLE_MEMBER;
        $newUser->save();

        $emailAuth = $this->_emailAuth->generateAuthToken($authPurpose['create_new'], self::TEMP_ID, $email, $password, 1 , 'd');
        $this->_emailAuth->updateUserToken($emailAuth['token'], $newUser->id);

        try {
            $urlMail =  !empty(request()->headers->get('Origin')) ? request()->headers->get('Origin') : '';
            $dataSendMail['verifyUrl'] = $urlMail . '/verifyUser?token='. $emailAuth['token'];
            $dataSendMail['mailUser'] = $email;
            $dataSendMail['subject'] = __('message.subject_mail_create_sale_user');
            dispatch((new SendMailCreateSaleUser($dataSendMail))->onQueue('sendMailCreateSaleUser'));
        }
        catch (\Exception $e) {
            Log::error($e);
            return false;
        }

        return $newUser->id;
    }

    public function verifyToken($token){
        $currentToken = $this->_emailAuth->getToken($token);
        if(!is_null($currentToken)) {
            return $currentToken;
        }

        return false;
    }

    public function forgotPassword($email){
        $saleUser = SaleUser::where('email', $email)->where('is_auth', SaleUser::USER_AUTH)->first();
        if (empty($saleUser)) {
            return false;
        }

        $authPurpose = Config::get('constants.auth_purpose');
        $emailForgotPass = $this->_emailAuth->sendMailForgotPassword($authPurpose['forgot_password'], $saleUser->id, $saleUser->email, 30 , 'i');
        if($emailForgotPass){
            try {
                $urlMail = !empty(request()->headers->get('Origin')) ? request()->headers->get('Origin') : '';
                $dataSendMail['verifyForgotPass'] = isset($emailForgotPass['token']) ? $urlMail . '/verifyForgotPassword?token='. $emailForgotPass['token'] : '';
                $dataSendMail['mailUser'] = isset($emailForgotPass['email']) ? $emailForgotPass['email'] : '';
                $dataSendMail['subject'] = __('message.subject_mail_forgot_password');
                dispatch((new SendMailForgotPasswordSaleUser($dataSendMail))->onQueue('sendMailForgotPasswordSaleUser'));
                return true;
            } catch (\Exception $e) {
                Log::error($e);
                return false;
            }
        }
        return false;
    }

    public function verifyForgotPassword($token, $authPurpose){
        try {
            $tokenData = EmailAuth::where('auth_code', $token)->where('auth_purpose', $authPurpose['forgot_password'])->firstOrFail();

            if ($tokenData) {
                $expireTime = Carbon::parse($tokenData->expiration_at);
                if($expireTime->greaterThan(Carbon::now())) {
                    $saleUser = SaleUser::where('email', $tokenData->email)->where('is_auth', SaleUser::USER_AUTH)->firstOrFail();
                    if ($saleUser) {
                        return true;
                    }
                }
            }
        } catch (\Exception $e) {
            Log::error($e);
            return false;
        }
    }

    public function changeForgotPassword($token, $password, $authPurpose){
        try {
            $tokenData = EmailAuth::where('auth_code', $token)->where('auth_purpose', $authPurpose['forgot_password'])->firstOrFail();

            if ($tokenData) {
                $expireTime = Carbon::parse($tokenData->expiration_at);
                if($expireTime->greaterThan(Carbon::now())) {
                    $saleUser = SaleUser::where('email', $tokenData->email)->where('is_auth', SaleUser::USER_AUTH)->firstOrFail();
                    if ($saleUser) {
                        $saleUser->password = hash('sha256', $password);
                        $saleUser->save();
                        // If the user shouldn't reuse the token later, delete the token
                        EmailAuth::where('email', $saleUser->email)->where('auth_code', $token)->where('auth_purpose', $authPurpose['forgot_password'])->delete();
                        return true;
                    }
                }
            }
        } catch (\Exception $e) {
            Log::error($e);
            return false;
        }
    }
}
