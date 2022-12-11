<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class teleponVad implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        if(strlen($value)<10){
            return false;
        }

        if(strlen($value)>13){
            return false;
        }

        if(substr($value, 0, 2) != "08"){
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'No. Telepon Harus 10-13 digit awalan 08';
    }
}
