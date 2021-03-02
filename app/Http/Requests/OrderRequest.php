<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'session.required' => "Необходимо указать сессию",
        ];
    }

    public function rules(): array
    {
        return [
            'session' => 'required',
        ];
    }
}
