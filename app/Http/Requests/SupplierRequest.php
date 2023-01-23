<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
            'Sup_Name' => 'required|max:400',
            'Addrs' => 'required|max:400',
            'Tel' => 'required|max:15',
            'Fax' => 'required|max:12',
            'Email' => 'required|email',
        ];
    }
}
