<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
            'Leger_No' => 'required',
            'Item_Type' => 'required',
            'Unit_Of_Issue' => 'required',
            'title_no' => 'required',
            'ict' => 'required',
            'category_type' => 'required',
            'comreserve' => 'required|numeric',
            'reorder' => 'numeric',
        ];
    }
}
