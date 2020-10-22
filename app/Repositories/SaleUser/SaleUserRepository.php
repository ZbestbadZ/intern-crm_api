<?php

namespace App\Repositories\SaleUser;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Config;
use App\Models\SaleUser;
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
            $urlMail = AppHelper::getDomain();
            $dataSendMail['verifyUrl'] = url($urlMail . '/verifyUser?token='. $emailAuth['token']);
            $dataSendMail['mailUser'] = $email;
            $dataSendMail['subject'] = "[CRM-Miichisoft] Xác thực Email";
            dispatch((new SendMailCreateSaleUser($dataSendMail))->onQueue('sendMailCreateSaleUser'));
        }
        catch (\Exception $e) {
            Log::error($e);
        }

        return [
            'userid' => $newUser->id,
            'expiredDate' => $emailAuth['expiredDate']
        ];
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
                $urlMail = AppHelper::getDomain();
                $dataSendMail['verifyForgotPass'] = isset($emailForgotPass['token']) ? url($urlMail . '/verifyForgotPassword?token='. $emailForgotPass['token']) : '';
                $dataSendMail['mailUser'] = isset($emailForgotPass['email']) ? $emailForgotPass['email'] : '';
                $dataSendMail['subject'] = "[CRM-Miichisoft] Yêu cầu mật khẩu";
                dispatch((new SendMailForgotPasswordSaleUser($dataSendMail))->onQueue('sendMailForgotPasswordSaleUser'));
                return true;
            } catch (\Exception $e) {
                Log::error($e);
                return false;
            }
        }
        return false;
    }
}
