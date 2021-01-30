<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'name.required' => "Заполните название для категории",
            'img.mimes' => "Неверный тип изображения: jpeg,png,jpg,gif",
            'img.max' => "Максимальный размер изображения 2 Мб",
            'icon.mimes' => "Неверный тип иконки: png,svg,gif",
            'icon.max' => "Максимальный размер иконки 1 Мб",
        ];
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'img'  => 'nullable|mimes:jpeg,png,jpg,gif|max:2048',
            'icon' => 'nullable|mimes:png,svg,gif|max:1024'
        ];
    }
}
