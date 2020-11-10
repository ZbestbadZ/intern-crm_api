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
    
    /**
     * CompaniesController construct
     *
     * @param CompaniesRepositoryInterface $companies
     */
    public function __construct(
        CompaniesRepositoryInterface $companies
    )
    {
        $this->repository = $companies;
    }

    /**
     * create company
     *
     * @param CompanyRequest $request
     * @return JsonResponse
     */
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

        
    /**
     *  Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $data = $request->all();
        $dataListCompaines = $this->repository->list($data);
        return response()->success($dataListCompaines);
    }

        
    /**
     * Detail company
     *
     * @param  $id
     * @return JsonResponse
     */
    public function show($id){
        $detailCompany = $this->repository->show($id);
        if ($detailCompany) {
            return response()->success($detailCompany, Response::HTTP_OK);
        }
        return response()->error('', __('message.not_found'), Response::HTTP_NOT_FOUND);
    }
    
    /**
     * delete company
     *
     * @param  $id
     * @return Response
     */
    public function delete($id){
        $deleteCompany = $this->repository->delete($id);
        if ($deleteCompany) {
            return response()->success(['message' => __('message.company.delete_success')], Response::HTTP_OK);
        }
        return response()->error('', __('message.company.delete_error'), Response::HTTP_BAD_REQUEST);
    }

        
    /**
     * update company
     *
     * @param   CompanyRequest $request
     * @param  $id
     * @return Response
     */
    public function update(CompanyRequest $request, $id){
        $data = $request->all();
        $updateCompany = $this->repository->update($id, $data);
        if ($updateCompany) {
            return response()->success([
                'message' => __('message.company.update_success')
            ], Response::HTTP_OK);
        }
        return response()->error('', __('message.error_system'), Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
