<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaleUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // $saleUserId = $this->request->get('id', 0);

        return [
            // 'email' => [
            //     'required',
            //     'max:191',
            //     Rule::unique('sale_user', 'email')->where(function ($query) {
            //         return $query->where('deleted_at', 0);
            //     })->ignore($saleUserId, 'id')
            // ],
            // 'name' => 'required|max:60',
            // 'password' => 'required'
        ];
    }
}
