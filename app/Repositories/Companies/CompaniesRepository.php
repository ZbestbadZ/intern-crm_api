<?php

namespace App\Repositories\Companies;

use Carbon\Carbon;
use App\Models\Companies;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

class CompaniesRepository implements CompaniesRepositoryInterface
{

    public function list($data){
        $idSale = Auth::id();
        $dataCompaniesTmp = Companies::whereHas('sales', function ($query)  use ($idSale) {
            $query->where('sale_user_id','=', $idSale);
        })
        ->with('domains');

        // begin process search
        // if(isset($data['name']) || !empty($data['name'])){
        //     $nameCompaines = $data['name'];
        //     $dataCompaniesTmp = $dataCompaniesTmp->where(function ($query) use ($nameCompaines)  {
        //                 $query->where('name_jp', 'LIKE', '%'.$nameCompaines.'%')
        //                     ->orWhere('name_vn', 'LIKE', '%'.$nameCompaines.'%');
        //             });
        // }
        // if(isset($data['id']) || !empty($data['id'])) {
        //     $dataCompaniesTmp = $dataCompaniesTmp->where('id',$data['id']);
        // }

        // if(isset($data['domains_id'])) {
        //     $arrDomains = $data['domains_id'];
        //     $dataCompaniesTmp = $dataCompaniesTmp->whereHas('domains', function ($query)  use ($arrDomains) {
        //         $query->whereIn('domains_id', $arrDomains);
        //     });
        // }
        // end process search
        $dataCompanies = $dataCompaniesTmp;
        return DataTables::of($dataCompanies)
                ->filter(function ($query) use ($data) {
                    if (request()->has('name') && !empty($data['name'])) {
                        $query->where('name_jp', 'like', "%" . $data['name'] . "%")
                        ->orWhere('name_vn', 'like', '%' . $data['name'] . '%');
                    }

                    if (request()->has('id') && !empty($data['id'])) {
                        $query->where('id', $data['id']);
                    }

                    if (request()->has('domains_id')) {
                        $arrDomains = $data['domains_id'];
                        dump(count($arrDomains));
                        $query->whereHas('domains', function ($query)  use ($arrDomains) {
                                $query->whereIn('domains_id', $arrDomains);
                            });
                    }
                })->make(true);
                
        // return DataTables::of($dataCompanies)->make(true);

    }
}
