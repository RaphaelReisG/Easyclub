<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FornecedorRequest extends FormRequest
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
            'cnpj' => 'required|min:14|max:14'
        ];
    
        // Adiciona as regras de senha apenas se for um formulário de criação
        if ($this->isMethod('post')) {
            $rules['cnpj'] = 'required|min:14|max:14|unique:empresas,cnpj';
        }
    
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => "O nome é obrigatório",
            'name.max' => "O nome não pode ser maior que 45 caracteres",

            'cnpj.required' => "O CNPJ é obrigatório",
            'cnpj.min' => 'O CNPJ deve ter 14 caracteres',
            'cnpj.max' => "O CNPJ deve ter 14 caracteres",
            'cnpj.unique' => 'Este CNPJ já está em uso',
           // 'cnpj.cnpj_validacao' => 'Este CNPJ não é valido',
        ];
    }
}
