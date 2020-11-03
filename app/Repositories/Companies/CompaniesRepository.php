<?php

namespace App\Repositories\Companies;

use App\Models\Companies;
use App\Models\OrbitCompanies;
use App\Repositories\Companies\CompaniesRepositoryInterface;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CompaniesRepository implements CompaniesRepositoryInterface
{
    public function create($data) {
        try {
            DB::beginTransaction();
            $newCompanies = new Companies();
            $newCompanies->name_jp            = $data['name_jp'];
            $newCompanies->name_vn            = $data['name_vn'];
            $newCompanies->category_id        = $data['category_id'];
            $newCompanies->phone              = isset($data['phone']) ? $data['phone'] : null;
            $newCompanies->fax                = isset($data['fax']) ? $data['fax'] : null;
            $newCompanies->website            = isset($data['website']) ? $data['website'] : null;
            $newCompanies->address            = isset($data['address']) ? $data['address'] : null;
            $newCompanies->description        = isset($data['description']) ? $data['description'] : null;
            $newCompanies->found_at           = isset($data['found_at']) ? $data['found_at'] : null;
            $newCompanies->scale_id           = isset($data['scale_id']) ? $data['scale_id'] : null;
            $newCompanies->charter_capital_id = isset($data['charter_capital_id']) ? $data['charter_capital_id'] : null;
            $newCompanies->revenue            = isset($data['revenue']) ? $data['revenue'] : null;
            $newCompanies->univalence         = isset($data['univalence']) ? $data['univalence'] : null;
            $newCompanies->save();
           
            // process create orbit with company
            $dataOrbit = isset($data['orbit_id']) ? $data['orbit_id'] : '';
            if(!empty($dataOrbit)){
                $newCompanies->orbit()->attach($dataOrbit);
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
}
