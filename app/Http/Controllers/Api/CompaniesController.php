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


    public function index(Request $request){
    }

    public function show($id){
        $detailCompany = $this->repository->show($id);
        if ($detailCompany) {
            return response()->success($detailCompany, Response::HTTP_OK);
        }
        return response()->error('', __('message.not_found'), Response::HTTP_NOT_FOUND);
    }

    public function delete($id){
        $deleteCompany = $this->repository->delete($id);
        if ($deleteCompany) {
            return response()->success(['message' => __('message.company.delete_success')], Response::HTTP_OK);
        }
        return response()->error('', __('message.company.delete_error'), Response::HTTP_BAD_REQUEST);
    }
}
