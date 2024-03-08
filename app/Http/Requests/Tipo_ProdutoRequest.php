<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Tipo_ProdutoRequest extends FormRequest
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
        $rules = [
            'name' => 'required|max:45',
            'description' => 'required|max:250'
        ];
    
        // Adiciona as regras de senha apenas se for um formulário de criação
        if ($this->isMethod('post')) {
            $rules['name'] = 'required|max:45|unique:tipo__produtos,name';
        }
    
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => "O nome é obrigatório",
            'name.max' => "O nome não pode ser maior que 45 caracteres",
            'name.unique' => 'Este Nome já está em uso',

            'description.required' => "O CNPJ é obrigatório",
            'description.max' => "O CNPJ deve ter 14 caracteres",
        ];
    }
}
