<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'name.required' => "Заполните название для магазина",
        ];
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
        ];
    }
}
