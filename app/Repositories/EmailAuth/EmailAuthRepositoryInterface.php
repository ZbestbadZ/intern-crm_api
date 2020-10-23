<?php

namespace App\Repositories\EmailAuth;


interface EmailAuthRepositoryInterface
{
    public function generateAuthToken($authPurpose, $userId, $email, $password, $expireTime, $timeUnit);

    public function getExpireDateTime($time, $unit);

    public function getToken($token);

    public function deleteToken($token);

    public function updateUserToken($token, $userId);
}
