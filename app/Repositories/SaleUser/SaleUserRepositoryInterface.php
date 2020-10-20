<?php

namespace App\Repositories\SaleUser;


interface SaleUserRepositoryInterface
{
    public function create($email, $name, $password);
}
