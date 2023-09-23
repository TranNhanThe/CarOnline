<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class ProductRequest extends FormRequest
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
            'product_name' => 'required|min:6',
            'product_price' => 'required|integer'
        ];
    }

    public function messages(){
        return [
            'product_name.required' => ':attribute bắt buộc phải nhập',
            'product_name.min' => ':attribute không được nhỏ hơn :min ký tự',
            'product_price.required' => ':attribute bắt buộc phải nhập',
            'product_price.integer' => ':attribute phải là số'
        ];
    }

    public function attributes(){
        return [
            'product_name' => 'Tên sản phẩm',
            'product_price' => 'Giá sản phẩm',
        ];
    }

    protected function withValidator($validator){
        $validator->after(function ($validator){

          if ($validator->errors()->count()>0){
            $validator->errors()->add('msg', 'Đã có lỗi xảy ra vui lòng kiểm tra lại');
          }

      
            
        });
       
    }

    protected function prepareForValidation()
    {
        $this -> merge([
            'create_at' => date('Y-m-d H:i:s'),
        ]);
    }

    protected function failedAuthorization(){
        //throw new AuthorizationException('Bạn đang truy cập vào khu vực cấm!');
        throw new HttpResponseException(abort(404));
        //throw new HttpResponseException(redirect('/')->with('msg','bạn không có quyền truy cập')->with('type', 'danger'));
    }
}
