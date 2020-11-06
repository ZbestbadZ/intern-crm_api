<?php

namespace App\Repositories\Companies;

use Carbon\Carbon;
use App\Models\Companies;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;

class CompaniesRepository implements CompaniesRepositoryInterface
{
    public function update($id, $data){
        try { 
            DB::beginTransaction();
            $idSale = Auth::id();
            $updateCompany = Companies::whereHas('sales', function ($query)  use ($idSale) {
                $query->where('sale_user_id','=', $idSale);
            })
            ->findOrFail($id);
            $updateCompany->update($data);

            $arrDomains = array_unique($data['domain_id']);
            if (array_filter($arrDomains)) {
                $updateCompany->domains()->sync($arrDomains);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return false;
        }
    }
}
