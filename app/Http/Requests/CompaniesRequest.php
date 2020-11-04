<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Rules\CheckTel;
use App\Enums\CategoryType;
use App\Enums\ScaleType;
use App\Enums\FondsType;

class CompaniesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return  Auth::guard('sale_user')->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name_jp' => [
                'bail',
                'required',
                'max:255',
            ],
            'name_vn' => [
                'bail',
                'required',
                'max:255',
            ],
            'established_at' => [
                'bail',
                'nullable',
                'date',
                'date_format:Y-m-d'
            ], 
            'category_enum' => [
                'bail',
                'required',
                'enum_value:'.CategoryType::class.',false',
            ], 
            'scale_enum' => [
                'bail',
                'nullable',
                'enum_value:'.ScaleType::class.',false',
            ], 
            'fonds_enum' => [
                'bail',
                'nullable',
                'enum_value:'.FondsType::class.',false',
            ], 
            'revenue' => [
                'bail',
                'nullable',
                'numeric',
                'min:0',
                'regex:/^\s*(?=.*[0-9])\d*(?:\.\d{1,2})?\s*$/'
            ], 
            'unit_price' => [
                'bail',
                'nullable',
                'numeric',
                'min:0',
                'regex:/^\s*(?=.*[0-9])\d*(?:\.\d{1,2})?\s*$/'
            ], 
            'website' => [
                'bail',
                'nullable',
                'url',
                'regex: /^((?:https?\:\/\/|www\.)(?:[-a-z0-9]+\.)*[-a-z0-9]+.*)$/'
            ], 
            'address' => [
                'bail',
                'nullable',
                'max:255',
            ], 
            'phone' => [
                'bail',
                'nullable',
                new CheckTel(__('validation.attributes.phone')),
            ], 
            'fax' => [
                'bail',
                'nullable',
                new CheckTel(__('validation.attributes.fax')),
            ], 
            'domain_id' => [
                'bail',
                'nullable',
                'numeric_array',
                'exists:m_domains,id'
            ], 
            'description' => [
                'nullable',
            ], 
            // 'customer_id' => [
            //     'nullable',
            // ], 

        ];
    }
}
