<?php

namespace App\Repositories\EmailAuth;

use App\Models\EmailAuth;
use App\Models\SaleUser;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class EmailAuthRepository implements EmailAuthRepositoryInterface
{

    public function generateAuthToken($authPurpose, $userId, $email, $password, $expireTime, $timeUnit)
    {
        $newAuth = new EmailAuth();
        $newAuth->authcode = Str::random(60);
        $newAuth->authpurpose = $authPurpose;
        $newAuth->sale_user_id = $userId;
        $newAuth->password_tmp = base64_encode($password);
        $newAuth->email = $email;
        $newAuth->expiration_at = $this->getExpireDateTime($expireTime, $timeUnit);
        $newAuth->save();

        return [
            'token' => $newAuth->authcode,
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
        $emailAuth = EmailAuth::where('authcode', '=', $token)->first();
        if($emailAuth) {
            $expireTime = Carbon::parse($emailAuth->expiration_at);
            if($expireTime->greaterThan(Carbon::now())) {
                $password = hash('sha256', base64_decode($emailAuth->password_tmp));
                $userId = $emailAuth->sale_user_id;
                DB::beginTransaction();
                try {
                    $saleUser = SaleUser::findOrFail($userId);
                    $saleUser->update([
                        'password' => $password
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
        EmailAuth::where('authcode', '=', $token)->delete();

        return true;
    }

    public function updateUserToken($token, $userId) {
        EmailAuth::where('authcode', '=', $token)->update(['sale_user_id' => $userId]);

        return true;
    }
}
