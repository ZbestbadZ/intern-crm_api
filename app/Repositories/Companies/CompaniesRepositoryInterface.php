<?php

namespace App\Repositories\Companies;


interface CompaniesRepositoryInterface
{
    public function create($data);
    public function list($data);
    public function show($id);
    public function update($id, $data);
    public function delete($id);
}
