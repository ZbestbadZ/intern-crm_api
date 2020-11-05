<?php

namespace App\Repositories\Companies;

use Carbon\Carbon;
use App\Models\Companies;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Log;

class CompaniesRepository implements CompaniesRepositoryInterface
{
    public function show($id){
        try {
            $idSale = Auth::id();
            $detailCompany = Companies::whereHas('sales', function ($query)  use ($idSale) {
                $query->where('sale_user_id','=', $idSale);
            })
            ->with('domains')
            ->where('id', $id)
            ->firstOrFail();
            return $detailCompany;
        } catch (\Exception $e) {
            Log::error($e);
            return false;
        }
    }


    public function delete($id){
        try { 
            DB::beginTransaction();
            $idSale = Auth::id();
            $deleteCompany = Companies::whereHas('sales', function ($query)  use ($idSale) {
                $query->where('sale_user_id','=', $idSale);
            })
            ->findOrFail($id);
            $deleteCompany->delete();
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return false;
        }
    }
}
