<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CompanyRequest;
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


    public function update(CompanyRequest $request, $id){
        $data = $request->all();
        $updateCompany = $this->repository->update($id, $data);
        if ($updateCompany) {
            return response()->success([
                'message' => __('message.comapny.update_success')
            ], Response::HTTP_OK);
        }
        return response()->error('', __('message.error_system'), Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
