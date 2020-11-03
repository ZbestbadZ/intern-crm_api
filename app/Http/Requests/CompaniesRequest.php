<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use App\Rules\CheckTel;

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
            'category_id' => [
                'bail',
                'required',
                'numeric'
            ], 
            'found_at' => [
                'bail',
                'nullable',
                'date',
                'date_format:Y-m-d H:i:s'
            ], 
            'scale_id' => [
                'nullable',
                'numeric',
            ], 
            'revenue' => [
                'nullable',
                'numeric',
            ], 
            'univalence' => [
                'nullable',
                'numeric',
            ], 
            'website' => [
                'bail',
                'nullable',
                'url',
                'regex: /^((?:https?\:\/\/|www\.)(?:[-a-z0-9]+\.)*[-a-z0-9]+.*)$/'
            ], 
            'address' => [
                'nullable',
                'max:255',
            ], 
            'phone' => [
                'nullable',
                new CheckTel(__('validation.attributes.phone')),
            ], 
            'fax' => [
                'nullable',
                new CheckTel(__('validation.attributes.fax')),
            ], 
            'orbit_id' => [
                'nullable',
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
