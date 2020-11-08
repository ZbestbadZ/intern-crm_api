<?php

namespace App\Repositories\Companies;

use App\Models\Companies;
use App\Repositories\Companies\CompaniesRepositoryInterface;
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
            $newCompanies->category           = $data['category'];
            $newCompanies->phone              = isset($data['phone']) ? $data['phone'] : null;
            $newCompanies->fax                = isset($data['fax']) ? $data['fax'] : null;
            $newCompanies->website            = isset($data['website']) ? $data['website'] : null;
            $newCompanies->address            = isset($data['address']) ? $data['address'] : null;
            $newCompanies->description        = isset($data['description']) ? $data['description'] : null;
            $newCompanies->established_at     = isset($data['established_at']) ? $data['established_at'] : null;
            $newCompanies->scale              = isset($data['scale']) ? $data['scale'] : null;
            $newCompanies->fonds              = isset($data['fonds']) ? $data['fonds'] : null;
            $newCompanies->revenue            = isset($data['revenue']) ? $data['revenue'] : null;
            $newCompanies->unit_price         = isset($data['unit_price']) ? $data['unit_price'] : null;
            $newCompanies->save();
           
            // process create orbit with company
            $dataDomain = isset($data['domain_id']) ? $data['domain_id'] : '';
            if(!empty($dataDomain)){
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
}
