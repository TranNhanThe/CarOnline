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
            
                'fullname' => 'required|min:5',
                'email' => 'required|email|'.$uniqueEmail,
                'group_id' => ['required', 'integer', function($attribute, $value, $fail){
                    if($value==0){
                        $fail('Bắt buộc phải chọn nhóm');  
                    }
                }], 
                'status' => 'required|integer',
                'password' => 'required|min:9|regex:/[A-Z]/'
            
        ];
    }

    public function messages(){
        return [
            'fullname.required' => 'Họ và tên bắt buộc phải nhập',
            'fullname.min' => 'Họ và tên phải từ :min ký tự trở lên',
            'email.required' => 'Email bắt buộc phải nhập',
            'email.email' => 'Email không đúng định dạng',
            'email.unique' => 'Email đã tồn tại', 
            'group_id.required' => 'Nhóm không được để trống',
            'group_id.integer' => 'Nhóm không hợp lệ',
            'status.required' => 'Trạng thái khôn được để trống',
            'status.integer' => 'Trạng thái không hợp lệ',
            'password.min' => 'Password phải từ 9 ký tự trở lên',
            'password.regex' => 'Password phải có một chữ cái viết hoa'
        ];
    }
}
