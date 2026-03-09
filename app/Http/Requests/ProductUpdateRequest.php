<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],

            'manufacturer_id' => [
                'required',
                'exists:manufacturers,id'
            ],

            'active_ingredients_id' => [
                'required',
                'array'
            ],

            'active_ingredients_id.*' => [
                'exists:active_ingredients,id'
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'O nome do produto é obrigatório.',
            'manufacturer_id.required' => 'Selecione um fabricante.',
            'manufacturer_id.exists' => 'Fabricante inválido.',
            'active_ingredients_id.*.exists' => 'Princípio ativo inválido.',
        ];
    }
}
