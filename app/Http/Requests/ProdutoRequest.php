<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProdutoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:45',
            'description' => 'required|max:250',
            'cost_price' => 'required',
            'sale_price' => 'required',
            'tipo_produto_id' => 'required|numeric',
            'fornecedor_id' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "O nome é obrigatório",
            'name.max' => "O nome não pode ser maior que 45 caracteres",

            'description.required' => "A descrição é obrigatório",
            'description.max' => "A descrição deve ter no maximo 250 caracteres",

            'cost_price.required' => "Este campo é obrigatório",
            'cost_price.decimal' => "Formato invalido",

            'sale_price.required' => "Este campo é obrigatório",
            'sale_price.decimal' => "Formato invalido",

            'tipo_produto_id.required' => "Este campo é obrigatório",
            'tipo_produto_id.numeric' => "Formato invalido",

            'fornecedor_id.required' => "Este campo é obrigatório",
            'fornecedor_id.numeric' => "Formato invalido",
        ];
    }
}
