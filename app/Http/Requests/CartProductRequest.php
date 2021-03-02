<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CartProductRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'product_id.required' => "Необходимо указать продукт",
//            'cart_id.required'    => "Необходимо указать корзину",
//            'quantity.max'        => "Превышает максимальное количество символов",
        ];
    }

    public function rules(): array
    {
        return [
            'product_id' => 'required',
//            'cart_id'    => 'required',
//            'quantity'   => 'required|max:150',
        ];
    }
}
