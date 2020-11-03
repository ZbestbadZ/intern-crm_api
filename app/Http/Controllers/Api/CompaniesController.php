<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CompaniesRequest;
use App\Repositories\Companies\CompaniesRepositoryInterface;


class CompaniesController extends Controller
{
    protected $repository;

    public function __construct(
        CompaniesRepositoryInterface $companies
    )
    {
        $this->repository = $companies;
    }

    public function create(CompaniesRequest $request){
        $data = $request->all();
        $dataCreateCompanies = $this->repository->create($data);
        return response()->success($dataCreateCompanies);
    }
}
