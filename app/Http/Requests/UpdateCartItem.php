<?php

namespace App\Http\Requests;

class UpdateCartItem extends APIRequest
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
            'quantity' => 'required|integer|between:0,10'
        ];
    }

    public function message()
    {
        return [
            'quantity.between' => '數量必須小於10'
        ];
    }
}
