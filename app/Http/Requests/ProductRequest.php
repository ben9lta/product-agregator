<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'name.required'        => "Заполните название для категории",
            'img.mimes'            => "Неверный тип изображения: jpeg,png,jpg,gif",
            'img.max'              => "Максимальный размер изображения 2 Мб",
            'category_id.required' => 'Необходимо выбрать категорию',
            'store_id.required'    => 'Необходимо выбрать магазин',
        ];
    }

    public function rules(): array
    {
        return [
            'name'        => 'required',
            'img'         => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required',
            'store_id'    => 'required',
        ];
    }
}
