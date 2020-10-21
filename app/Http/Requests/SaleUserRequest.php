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
        $saleUserId = $this->request->get('id', 0);
        return [
            'email' => [
                'bail',
                'required',
                'max:191',
                'email',
                'regex:/(.*)@miichisoft\.(com|net)/i',
                Rule::unique('sale_user', 'email')->where(function ($query) {
                    return $query->whereNull('deleted_at');
                })->ignore($saleUserId, 'id')
            ],
            'password' => [
                'bail',
                'required',
                'min:8',
                'regex:/[a-z]/',      // must contain at least one lowercase letter
                'regex:/[A-Z]/',      // must contain at least one uppercase letter
                'regex:/[0-9]/',      // must contain at least one digit
                'regex:/[@$!%*#?&]/', // must contain a special character
            ]
        ];
    }
}
