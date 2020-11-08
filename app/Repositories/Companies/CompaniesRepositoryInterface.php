<?php

namespace App\Repositories\Companies;


interface CompaniesRepositoryInterface
{
    public function create($data);
    public function list($data);
}
