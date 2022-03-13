<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HouseCreateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'street' =>'required|string',
            'area'=>'required|regex:/^\d*(\.\d{2})?$/',
            'number_of_rooms'=>'required|integer',
            'price' =>'required|regex:/^\d*(\.\d{2})?$/',
            'date_of_construction'=>'required|date',
            'there_are_ghosts'=>'required|boolean'
        ];
    }

}
