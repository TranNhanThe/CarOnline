<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubRequest extends FormRequest
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
            'received_date' => 'required|date',
            'return_date'=> 'required|date',
            'id_ad_rent' => 'required',
            'days' => 'required',
            'id_dealer' => 'required',
            'id_car' => 'required',
            'deposit' => 'required',
            'renter' => 'required',
            'total' => 'required'
        ];
    }
    public function messages(){
        return [
            'received_date.required' => 'Mời bạn chọn ngày nhận',
            'received_date.date' => 'Dữ liệu có vẻ không hợp lệ',
            'return_date.date' => 'Dữ liệu có vẻ không hợp lệ',
            'return_date.required' => 'Mời bạn chọn ngày trả',
            'id_ad_rent.required' => 'Không thấy mã tin',
            'days.required' => 'Không thấy số ngày',
            'id_dealer.required' => 'Không thấy dữ liệu chủ xe',
            'id_car.required' => 'Không thấy id xe thuê đâu',
            'deposit.required' => 'Không thấy tiền cọc',
            'renter.required' => 'Không thấy dữ liệu người thuê',
            'total.required' => 'Không thấy dữ liệu tổng cộng',
        ];
    }
}
