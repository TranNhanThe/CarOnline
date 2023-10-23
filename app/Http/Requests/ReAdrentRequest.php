<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReAdrentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'price' => 'required|min:6',

            'id_adtype' => ['required', 'integer', function($attribute, $value, $fail){
                if($value==0){
                    $fail('Mời bạn chọn gói');
                }
            }],

            // 'expiration_date' => 'required|date|date_format:Y-m-d|after:' . now()->format('Y-m-d'),

             'rentaldays' => 'required',
             'total' => 'required',

        ];
    }
    public function messages(){
        return [
            'price.required' => 'Mời bạn nhập giá',
            'price.min' => 'Giá xe phải từ 100.000 vnđ trở lên',
            // 'expiration_date.required' => 'Mời bạn chọn ngày hết hạn',
            // 'expiration_date.after' => 'Hãy chọn từ ngày mai trở về sau',
            'car_name.required' => 'Tên xe bắt buộc phải nhập',
            'car_name.min' => 'tên xe phải từ :min ký tự trở lên',
            'rentaldays.required' => 'mời bạn chọn số ngày hiển thị' 
        ];
    }
}
