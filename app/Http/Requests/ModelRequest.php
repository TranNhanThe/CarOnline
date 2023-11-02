<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModelRequest extends FormRequest
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
        $uniqueModel = 'unique:model';
        if(session('id')){
             $id = session('id');
             $uniqueModel = 'unique:model.name,' .$id;
        }
        return [
          'name' => 'required|min:3|'.$uniqueModel,
          'id_make' => 'required'
        ];
    }
    public function messages(){
        return [
            'name.required' => 'Tên bắt buộc phải nhập',
            'name.min' => 'Tên có vẻ không đúng',
            'name.unique' => 'Model đã tồn tại', 
            'id_make.required' => 'Mời chọn hãng'
        ];
    }
}
