<?php

namespace App\Repositories\SaleUser;


interface SaleUserRepositoryInterface
{
    public function create($email, $password);

    public function verifyToken($token);

    public function profile($id, $email);
}
