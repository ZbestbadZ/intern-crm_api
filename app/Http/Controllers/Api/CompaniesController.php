<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Companies\CompaniesRepositoryInterface;
use Illuminate\Http\Response;


class CompaniesController extends Controller
{
    protected $repository;

    public function __construct(
        CompaniesRepositoryInterface $companies
    )
    {
        $this->repository = $companies;
    }

    public function list(Request $request){
        $data = $request->all();
        $dataListCompaines = $this->repository->list($data);
        return response()->success($dataListCompaines);
    }
}
