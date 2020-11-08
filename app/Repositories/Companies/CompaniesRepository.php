<?php

namespace App\Repositories\Companies;

use App\Models\Companies;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Yajra\Datatables\DataTables;

class CompaniesRepository implements CompaniesRepositoryInterface
{
    public function create($data)
    {
        try {
            DB::beginTransaction();
            $newCompanies = new Companies();
            $newCompanies->name_jp = $data['name_jp'];
            $newCompanies->name_vn = $data['name_vn'];
            $newCompanies->category = $data['category'];
            $newCompanies->phone = isset($data['phone']) ? $data['phone'] : null;
            $newCompanies->fax = isset($data['fax']) ? $data['fax'] : null;
            $newCompanies->website = isset($data['website']) ? $data['website'] : null;
            $newCompanies->address = isset($data['address']) ? $data['address'] : null;
            $newCompanies->description = isset($data['description']) ? $data['description'] : null;
            $newCompanies->established_at = isset($data['established_at']) ? $data['established_at'] : null;
            $newCompanies->scale = isset($data['scale']) ? $data['scale'] : null;
            $newCompanies->fonds = isset($data['fonds']) ? $data['fonds'] : null;
            $newCompanies->revenue = isset($data['revenue']) ? $data['revenue'] : null;
            $newCompanies->unit_price = isset($data['unit_price']) ? $data['unit_price'] : null;
            $newCompanies->save();

            // process create orbit with company
            $dataDomain = isset($data['domain_id']) ? $data['domain_id'] : '';
            if (!empty($dataDomain)) {
                $newCompanies->domains()->attach($dataDomain);
            }

            // process create sale with company
            $newCompanies->sale()->attach(Auth::id());

            // process create customer with company
            // $dataCustomer = isset($data['customer_id']) ? $data['customer_id'] : '';
            // if(!empty($dataCustomer)){
            //     $newCompanies->customer()->attach($dataCustomer);
            // }

            DB::commit();
            return $newCompanies->id;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception);
            return false;
        }
    }
    public function list($data){
        $idSale = Auth::id();
        $limit  = config('constants.limit');
        $page = config('constants.page');

        $dataCompaniesTmp = Companies::whereHas('sales', function ($query)  use ($idSale) {
            $query->where('sale_user_id','=', $idSale);
        })
        ->with('domains');

        $recordsTotal = $dataCompaniesTmp->count();

        if(isset($data['size']) && !empty($data['size'])){
            $limit = $data['size'];
        }
        if(isset($data['page']) && !empty($data['page'])){
            $page = $data['page'];
        }

        if(isset($data['name']) && !empty($data['name'])){
            $nameCompaines = $data['name'];
            $dataCompaniesTmp = $dataCompaniesTmp->where(function ($query) use ($nameCompaines)  {
                        $query->where('name_jp', 'LIKE', '%'.$nameCompaines.'%')
                            ->orWhere('name_vn', 'LIKE', '%'.$nameCompaines.'%');
                    });
        }
        if(isset($data['id']) && !empty($data['id'])) {
            $dataCompaniesTmp = $dataCompaniesTmp->where('id',$data['id']);
        }

        if(isset($data['domain_id'])) {
            $arrDomains = array_unique($data['domain_id']);
             if (array_filter($arrDomains)) {
                $dataCompaniesTmp = $dataCompaniesTmp->whereHas('domains', function ($query)  use ($arrDomains) {
                                                    $query->whereIn('domain_id', $arrDomains);
                });
            }

        }
        $start = ($page - 1) * $limit;
        $dataCompaniesTmp->skip($start)->take($limit);
        $dataCompanies = $dataCompaniesTmp->get();
        $dataCompanies->transform(function ($item) {
            $item['domains_show'] = $item['domains']->pluck('label');
            unset($item['domains']);
            return $item;
        });

        return DataTables::of($dataCompanies)
                    ->with([
                        "recordsTotal" => $recordsTotal,
                    ])
                    ->make(true);
    }
}
