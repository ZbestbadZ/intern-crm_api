<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckTel implements Rule
{
    private $field;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($field)
    {
    $this->field = $field;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
    $checkNull = preg_replace("/[\(\)\+\-]+/", '', $value);
    $checkNull = trim($checkNull);
    if (strlen($checkNull) === 0){
      return false;
    }

        $str = preg_replace('/[\d\(\)\+\-]+/', '', $value);

        $str = trim($str);

        return (strlen($str) === 0) ? true : false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return $this->field;
    }
}
