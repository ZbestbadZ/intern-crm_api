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
            $urlMail = config('app.domain_front_end');
            $dataSendMail['verifyUrl'] = $urlMail . '/verifyUser?token='. $emailAuth['token'];
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

    public function profile($id, $email){
        $profileSaleUser = SaleUser::where('id', $id)->where('email', $email)
                            ->with('profile')
                            ->first();
        if(!empty($profileSaleUser['profile'])){
            return  $profileSaleUser;
        }
        return null;
    }
}
