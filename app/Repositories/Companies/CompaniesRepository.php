<?php

namespace App\Repositories\Companies;

use App\Models\Company;
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
            $newCompany = new Company();
            // dump($newCompany->getLabel()->where('id', ));
            $newCompany->name_jp = $data['name_jp'];
            $newCompany->name_vn = $data['name_vn'];
            $newCompany->category = $data['category'];
            $newCompany->phone = isset($data['phone']) ? $data['phone'] : null;
            $newCompany->fax = isset($data['fax']) ? $data['fax'] : null;
            $newCompany->website = isset($data['website']) ? $data['website'] : null;
            $newCompany->address = isset($data['address']) ? $data['address'] : null;
            $newCompany->description = isset($data['description']) ? $data['description'] : null;
            $newCompany->established_at = isset($data['established_at']) ? $data['established_at'] : null;
            $newCompany->scale = isset($data['scale']) ? $data['scale'] : null;
            $newCompany->capital = isset($data['capital']) ? $data['capital'] : null;
            $newCompany->revenue = isset($data['revenue']) ? $data['revenue'] : null;
            $newCompany->unit_price = isset($data['unit_price']) ? $data['unit_price'] : null;
            $newCompany->save();

            // process create orbit with company
            $dataDomain = isset($data['domain_id']) ? $data['domain_id'] : '';
            if (!empty($dataDomain)) {
                $newCompany->domains()->attach($dataDomain);
            }

            // process create sale with company
            $newCompany->sale()->attach(Auth::id());

            // process create customer with company
            // $arrCustomer = array_unique($data['customer_id']);

            DB::commit();
            return $newCompany->id;
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

        $dataCompaniesTmp = Company::whereHas('sale', function ($query) use ($idSale) {
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
            $detailCompany = Company::whereHas('sale', function ($query)  use ($idSale) {
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
            $updateCompany = Company::whereHas('sale', function ($query)  use ($idSale) {
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
            $deleteCompany = Company::whereHas('sale', function ($query)  use ($idSale) {
                $query->where('sale_user_id','=', $idSale);
            })
            ->findOrFail($id);

            // $deleteCompany->cutomers()->delete();
            $deleteCompany->domains()->sync([]);
            $deleteCompany->sale()->sync([]);
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
