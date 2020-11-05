<?php

namespace App\Repositories\Companies;


interface CompaniesRepositoryInterface
{
    public function show($id);

    public function delete($id);
}
