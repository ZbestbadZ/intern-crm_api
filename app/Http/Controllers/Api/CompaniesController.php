<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\CompanyRequest;
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

    public function create(CompanyRequest $request)
    {
        $data = $request->all();
        $dataCreateCompanies = $this->repository->create($data);
        if ($dataCreateCompanies) {
            return response()->success([
                'id' => $dataCreateCompanies
            ]);
        }
        return response()->error('', __('message.error_system'), Response::HTTP_INTERNAL_SERVER_ERROR);
    }
    public function index(Request $request){
        $data = $request->all();
        $dataListCompaines = $this->repository->list($data);
        return response()->success($dataListCompaines);
    }
}
