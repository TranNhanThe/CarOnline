<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Uppercase implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
        if (strtoupper($value) !== $value) {
              $fail('Tên sản phẩm phải viết hoa');
      
        }
    }
    
    public function passes($attribute, $value){

        

        if ($value===mb_strtoupper($value, 'UTF-8')){
            return true;
        }

        return false;
    }
    public function message(){
        if(trans('validation.custom.product_name.uppercase')){
            return trans('validation.custom.product_name.uppercase');
        }
        return trans('validation.uppercase');
    }
}
