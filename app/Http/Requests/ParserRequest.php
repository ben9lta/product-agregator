<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ParserRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function messages(): array
    {
        return [
            'parser_name.required'  => "Заполните название парсера",
            'option.name.required'         => "Заполните заголовок товара селектором",
            'url.required'          => "Укажите ссылку для парсинга товаров",
            'category_id.required'  => 'Необходимо выбрать категорию',
            'store_id.required'     => 'Необходимо выбрать магазин',
        ];
    }

    public function rules()
    {
        return [
            'parser_name'  => 'required',
            'option.name'         => 'required',
            'url'          => 'required',
            'category_id'  => 'required',
            'store_id'     => 'required',
        ];
    }
}
