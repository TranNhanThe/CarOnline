<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MakeRequest extends FormRequest
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
        $uniqueMake = 'unique:make';
        if(session('id')){
             $id = session('id');
             $uniqueMake = 'unique:make.name,' .$id;
        }
        return [
          'name' => 'required|min:3|'.$uniqueMake,
        ];
    }
    public function messages(){
        return [
            'name.required' => 'Tên bắt buộc phải nhập',
            'name.unique' => 'Hãng đã tồn tại', 
            'name.min' => 'Tên hãng có vẻ không đúng',
        ];
    }
}
