<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RentalRequest extends FormRequest
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
        // $uniqueEmail = 'unique:users';
        // if(session('id')){
        //      $id = session('id');
        //      $uniqueEmail = 'unique:users,email,' .$id;
        // }
       
        return [
                'car_name' => 'required|min:9',
                
                // 'id_user' => ['required', 'integer', function($attribute, $value, $fail){
                //     if($value==0){
                //         $fail('Bắt buộc phải chọn User');  
                //     }
                // }], 

                'id_model' => ['required', 'integer', function($attribute, $value, $fail){
                    if($value==0){
                        $fail('Bắt buộc phải chọn Model xe');  
                    }
                }],

                'id_fuel' => ['required', 'integer', function($attribute, $value, $fail){
                    if($value==0){
                        $fail('Bắt buộc phải chọn nhiên liệu');  
                    }
                }],

                'id_drivetrain' => ['required', 'integer', function($attribute, $value, $fail){
                    if($value==0){
                        $fail('Bắt buộc phải chọn dẫn động');  
                    }
                }],

                'id_transmission' => ['required', 'integer', function($attribute, $value, $fail){
                    if($value==0){
                        $fail('Bắt buộc phải chọn hộp số');  
                    }
                }],

                'id_bodytype' => ['required', 'integer', function($attribute, $value, $fail){
                    if($value==0){
                        $fail('Bắt buộc phải chọn dòng xe');  
                    }
                }],

                'id_make' => ['required', 'integer', function($attribute, $value, $fail){
                    if($value==0){
                        $fail('Bắt buộc phải chọn hãng');  
                    }
                }],

                'location' => 'required',

                'id_province' => ['required', 'integer', function($attribute, $value, $fail){
                    if($value==0){
                        $fail('Bắt buộc phải chọn tỉnh');  
                    }
                }],

                'engine' => 'required',

                'exterior_color' => 'required',

                'interior_color' => 'required',
                'vin' => 'required|min:17',
                'no_accident' => 'required|integer',
                'price' => 'required',
                'seat' => 'required|integer',
                'driver' => 'required|integer',
                'image' => 'required'

                

                // 'status' => 'required|integer'
            
        ];
    }

    public function messages(){
        return [
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

            'price.required' => 'Giá bắt buộc phải nhập',

            'seat.required' => 'Số ghế ngồi bắt buộc phải nhập',

            'seat.integer' => 'dữ liệu nhập vào không hợp lệ',

            'driver.required' => 'Xe có kèm tài xế hay không',

            'driver.integer' => 'Dữ liệu không hợp lệ',

            'image.required' => 'Mời nhập hình ảnh'
            
        ];
    }
}
