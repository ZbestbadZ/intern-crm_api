<?php

namespace App\Repositories\Companies;

use Carbon\Carbon;
use App\Models\Companies;
use App\Models\Domain;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class CompaniesRepository implements CompaniesRepositoryInterface
{
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
