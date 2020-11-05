<?php

namespace App\Repositories\Companies;

use Carbon\Carbon;
use App\Models\Companies;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;
use App\Jobs\SendMailDeleteCompany;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Config;

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

            // send mail admin
            $profileSaleUser = Auth::user()->profile()->first();
            $fullNameSaleUser = !empty($profileSaleUser) ? $profileSaleUser->full_name : '';
            $dataSendMail['mailSaleAdmin'] = Config::get('constants.mail_admin');
            $dataSendMail['nameCompany'] = isset($deleteCompany) ? $deleteCompany['name_jp'] : '';
            $dataSendMail['time'] = Carbon::now();
            $dataSendMail['nameUserDelete'] = $fullNameSaleUser;
            $dataSendMail['subject'] = __('message.company.subject_mail_delete_company');
            dispatch((new SendMailDeleteCompany($dataSendMail))->onQueue('sendMailDeleteCompany'));
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return false;
        }
    }
}
