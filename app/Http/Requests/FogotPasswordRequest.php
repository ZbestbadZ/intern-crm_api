<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FogotPasswordRequest extends FormRequest
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
        return [
            'email' => [
                'bail',
                'required',
                'max:191',
                'email',
                'regex:/(.*)@miichisoft\.(com|net)/i',
            ],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'Email is required.',
            'email.max' => 'The :attribute may not be greater than :max characters.',
            'email.email' => 'The :attribute must be a valid email address.',
            'email.regex' => 'The :attribute format is invalid.',
        ];
    }
}
