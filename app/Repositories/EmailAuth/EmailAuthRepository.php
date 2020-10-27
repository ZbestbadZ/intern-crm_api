<?php

namespace App\Repositories\EmailAuth;

use App\Models\EmailAuth;
use App\Models\SaleUser;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class EmailAuthRepository implements EmailAuthRepositoryInterface
{

    public function generateAuthToken($authPurpose, $userId, $email, $password, $expireTime, $timeUnit)
    {
        $newAuth = new EmailAuth();
        $newAuth->auth_code = Str::random(60);
        $newAuth->auth_purpose = $authPurpose;
        $newAuth->sale_user_id = $userId;
        $newAuth->password_tmp = base64_encode($password);
        $newAuth->email = $email;
        $newAuth->expiration_at = $this->getExpireDateTime($expireTime, $timeUnit);
        $newAuth->save();

        return [
            'token' => $newAuth->auth_code,
            'email' => $newAuth->email,
            'createtime' => $newAuth->created_at,
            'expiredDate' => $newAuth->expiration_at
        ];
    }

    public function getExpireDateTime($time, $unit) {
        switch ($unit) {
            case 'H' :
                return Carbon::now()->addHours($time);
            case 'd' :
                return Carbon::now()->addDays($time);
            case 'i' :
                return Carbon::now()->addMinutes($time);
        }

        return null;
    }

    public function getToken($token) {
        $emailAuth = EmailAuth::where('auth_code', '=', $token)->first();
        if($emailAuth) {
            $expireTime = Carbon::parse($emailAuth->expiration_at);
            if($expireTime->greaterThan(Carbon::now())) {
                $password = hash('sha256', base64_decode($emailAuth->password_tmp));
                $userId = $emailAuth->sale_user_id;
                DB::beginTransaction();
                try {
                    $saleUser = SaleUser::findOrFail($userId);
                    $saleUser->update([
                        'password' => $password,
                        'is_auth' => SaleUser::USER_AUTH
                    ]);
                    DB::commit();
                    $deleteToken  = $this->deleteToken($token);
                    return $userId;
                } catch (\Exception $exception) {
                    DB::rollBack();
                    return null;
                }
            }
        }

        return null;
    }

    public function deleteToken($token) {
        $authPurpose = Config::get('constants.auth_purpose');
        EmailAuth::where('auth_code', '=', $token)->where('auth_purpose', $authPurpose['create_new'])->delete();

        return true;
    }

    public function updateUserToken($token, $userId) {
        EmailAuth::where('auth_code', '=', $token)->update(['sale_user_id' => $userId]);

        return true;
    }

    public function sendMailForgotPassword($authPurpose, $userId, $email, $expireTime, $timeUnit) {
        $email = str_replace(' ', '', $email);
        EmailAuth::where('email', $email)->where('auth_purpose', $authPurpose)->delete();

        //create a new token to be sent to the sale user.
        $emailForgotPass = new EmailAuth();
        $emailForgotPass->auth_code = Str::random(60);
        $emailForgotPass->auth_purpose = $authPurpose;
        $emailForgotPass->sale_user_id = $userId;
        $emailForgotPass->email = $email;
        $emailForgotPass->expiration_at = $this->getExpireDateTime($expireTime, $timeUnit);
        $emailForgotPass->save();

        $token = $emailForgotPass->auth_code;
        $createdTime = date('Y-m-d H:i:s',strtotime($emailForgotPass->created_at));
        $expiredDate = $emailForgotPass->expiration_at;
        return [
            'token' => $token,
            'email' => $email,
            'createtime' => $createdTime,
            'expiredDate' => $expiredDate
        ];
    }
}
