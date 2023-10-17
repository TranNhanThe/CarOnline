<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdrentRequest extends FormRequest
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

            'expiration_date' => 'required|date|date_format:Y-m-d|after:' . now()->format('Y-m-d'),


        ];
    }
    public function messages(){
        return [
            'price.required' => 'Mời bạn nhập giá',
            'price.min' => 'Giá xe phải từ 100.000 vnđ trở lên',
            
            'expiration_date.required' => 'Mời bạn chọn ngày hết hạn',
            'expiration_date.after' => 'Hãy chọn từ ngày mai trở về sau',
            'car_name.required' => 'Tên xe bắt buộc phải nhập',
            'car_name.min' => 'tên xe phải từ :min ký tự trở lên',
            
            // 'id_user.required' => 'User không được để trống',
            // 'id_user.integer' => 'User không hợp lệ',

            // 'id_model.required' => 'Model không được để trống',
            // 'id_model.integer' => 'Model không hợp lệ',

            // 'id_fuel.required' => 'Nhiên liệu không được để trống',
            // 'id_fuel.integer' => 'Nhiên liệu không hợp lệ',

            // 'id_drivetrain.required' => 'Dẫn động không được để trống',
            // 'id_drivetrain.integer' => 'Dẫn động không hợp lệ',

            // 'id_transmission.required' => 'Hộp số không được để trống',
            // 'id_transmission.integer' => 'Hộp số không hợp lệ',

            // 'id_bodytype.required' => 'Dòng xe không được để trống',
            // 'id_bodytype.integer' => 'Dòng xe không hợp lệ',

            // 'id_make.required' => 'Hãng không được để trống',
            // 'id_make.integer' => 'Hãng không hợp lệ',

            // 'id_province.required' => 'Tỉnh không được để trống',
            // 'id_province.integer' => 'Tỉnh không hợp lệ',

            'location.required' => 'Địa chỉ bắt buộc phải nhập',

            'engine.required' => 'Động cơ bắt buộc phải nhập',

            'exterior_color.required' => 'Màu ngoại thất bắt buộc phải nhập',

            'interior_color.required' => 'Màu nội thất bắt buộc phải nhập',

            'vin.required' => 'Số vin bắt buộc phải nhập',

            'vin.min' => 'Số vin phải từ :min ký tự trở lên',

            'no_accident.required' => 'Từng bị va chạm hay chưa',

            'no_accident.integer' => 'Dữ liệu không hợp lệ',

            'mota.required' => 'Hãy viết mô tả',

            'seat.required' => 'Số ghế ngồi bắt buộc phải nhập',

            'seat.integer' => 'dữ liệu nhập vào không hợp lệ',

            'driver.required' => 'Xe có kèm tài xế hay không',

            'driver.integer' => 'Dữ liệu không hợp lệ',

            'image.required' => 'Mời nhập hình ảnh'
            
        ];
    }
}
