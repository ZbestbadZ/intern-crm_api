<?php

namespace App\Repositories\Companies;

use App\Models\Companies;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Yajra\Datatables\DataTables;
use App\Jobs\SendMailDeleteCompany;
use Illuminate\Support\Facades\Config;
use Carbon\Carbon;

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
            // $arrCustomer = array_unique($data['customer_id']);

            DB::commit();
            return $newCompanies->id;
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception);
            return false;
        }
    }

    public function list($data)
    {
        $idSale = Auth::id();
        $limit = config('constants.limit');
        $page = config('constants.page');

        $dataCompaniesTmp = Companies::whereHas('sale', function ($query) use ($idSale) {
            $query->where('sale_user_id', '=', $idSale);
        })
            ->with('domains');

        $recordsTotal = $dataCompaniesTmp->count();

        if (isset($data['size']) && !empty($data['size'])) {
            $limit = $data['size'];
        }
        if (isset($data['page']) && !empty($data['page'])) {
            $page = $data['page'];
        }

        if (isset($data['name']) && !empty($data['name'])) {
            $nameCompaines = $data['name'];
            $dataCompaniesTmp = $dataCompaniesTmp->where(function ($query) use ($nameCompaines) {
                $query->where('name_jp', 'LIKE', '%' . $nameCompaines . '%')
                    ->orWhere('name_vn', 'LIKE', '%' . $nameCompaines . '%');
            });
        }
        if (isset($data['id']) && !empty($data['id'])) {
            $dataCompaniesTmp = $dataCompaniesTmp->where('id', $data['id']);
        }

        if (isset($data['domain_id'])) {
            $arrDomains = array_unique($data['domain_id']);
            if (array_filter($arrDomains)) {
                $dataCompaniesTmp = $dataCompaniesTmp->whereHas('domains', function ($query) use ($arrDomains) {
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

    public function show($id){
        try {
            $idSale = Auth::id();
            $detailCompany = Companies::whereHas('sale', function ($query)  use ($idSale) {
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

    public function update($id, $data){
        try { 
            DB::beginTransaction();
            $idSale = Auth::id();
            $updateCompany = Companies::whereHas('sale', function ($query)  use ($idSale) {
                $query->where('sale_user_id','=', $idSale);
            })
            ->findOrFail($id);

            // process update company with domain
            $arrDomains = array_unique($data['domain_id']);
            if (array_filter($arrDomains)) {
                $updateCompany->domains()->sync($arrDomains);
            }

            // process create company with customer
            // $arrCustomer = array_unique($data['customer_id']);

            $updateCompany->update($data);
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e);
            return false;
        }
    }

    public function delete($id){
        try {
            DB::beginTransaction();
            $idSale = Auth::id();
            $deleteCompany = Companies::whereHas('sale', function ($query)  use ($idSale) {
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
