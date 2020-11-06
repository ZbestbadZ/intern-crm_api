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
        $dataCompanies = Companies::whereHas('sales', function ($query)  use ($idSale) {
            $query->where('sale_user_id','=', $idSale);
        })
        ->with('domains')->get();
        $dataCompanies->transform(function ($item) {
            $item['domains_show'] = $item['domains']->pluck('label');
            unset($item['domains']);
            return $item;
        });

    return DataTables::of($dataCompanies)
                    ->filter(function ($query) use ($data) {
                        if (request()->has('name') && !empty($data['name'])) {
                            $query->where('name_jp', 'like', "%" . $data['name'] . "%")
                            ->orWhere('name_vn', 'like', '%' . $data['name'] . '%');
                        }

                        if (request()->has('id') && !empty($data['id'])) {
                            $query->where('id', $data['id']);
                        }

                        if (request()->has('domain_id')) {
                            $arrDomains = array_unique($data['domain_id']);
                            if (array_filter($arrDomains)) {
                                $query->whereHas('domains', function ($query)  use ($arrDomains) {
                                        $query->whereIn('domain_id', $arrDomains);
                                    });
                            }
                        }
                    })->make(true);
    }
}
