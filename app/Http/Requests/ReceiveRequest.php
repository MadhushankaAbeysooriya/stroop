<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReceiveRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'Item_Auto_Id' => 'required',
            'quentity' => 'required',
            'Voucher_No' => 'required',
            'price' => 'required',
            'rec_from' => 'required',
        ];
    }
}
