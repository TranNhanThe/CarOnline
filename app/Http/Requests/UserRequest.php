<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $uniqueEmail = 'unique:users';
        if(session('id')){
             $id = session('id');
             $uniqueEmail = 'unique:users,email,' .$id;
        }
       
        return [
                // 'credit' => 'required',
                'fullname' => 'required|min:5',
                'email' => 'required|email|'.$uniqueEmail,
                'phone' => 'required|min:10|max:12',
                'cccd' => 'required|min:12|max:12',
                
                // 'group_id' => ['required', 'integer', function($attribute, $value, $fail){
                //     if($value==0){
                //         $fail('Bắt buộc phải chọn nhóm');  
                //     }
                // }], 
                // 'status' => 'required|integer',
                'password' => 'required|min:9|regex:/[A-Z]/',
                
            
        ];
    }

    public function messages(){
        return [
            'fullname.required' => 'Họ và tên bắt buộc phải nhập',
            'fullname.min' => 'Họ và tên phải từ :min ký tự trở lên',
            'phone.required' => 'Mời nhập số điện thoại',
            'phone.min' => 'Số điện thoại phải từ :min số trở lên',
            'phone.max' => 'Số điện thoại không quá :max số',
            'cccd.required' => 'Mời nhập số Căn cước',
            'cccd.min' => 'Số căn cước phải từ :min số trở lên',
            'cccd.max' => 'Số căn cước không quá :max số',
            'email.required' => 'Email bắt buộc phải nhập',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại', 
            
            // 'group_id.required' => 'Nhóm không được để trống',
            // 'group_id.integer' => 'Nhóm không hợp lệ',
            // 'status.required' => 'Trạng thái khôn được để trống',
            // 'status.integer' => 'Trạng thái không hợp lệ',
            'password.min' => 'Password phải từ 9 ký tự trở lên',
            'password.regex' => 'Password phải có một chữ cái viết hoa'
        ];
    }
}
