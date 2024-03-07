<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpresaRequest extends FormRequest
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
            'cnpj' => 'required|min:14|max:14|cnpj_validacao'
        ];
    
        // Adiciona as regras de senha apenas se for um formulário de criação
        if ($this->isMethod('post')) {
            $rules['cnpj'] = 'required|min:14|max:14|unique:empresas,cnpj|cnpj_validacao';
        }
    
        return $rules;
        
        
    }

    public function cnpjValidacao($attribute, $value, $parameters, $validator)
    {
        $cnpj = intval($value);




        // Calcula o primeiro dígito verificador
        $soma = 0;
        for ($i = 0; $i < 12; $i++) {
            $soma += intval($cnpj[$i]) * (13 - $i);
        }
        $resto = $soma % 11;
        $digito1 = ($resto < 2) ? 0 : 11 - $resto;

        // Calcula o segundo dígito verificador
        $soma = 0;
        for ($i = 0; $i < 13; $i++) {
            $soma += intval($cnpj[$i]) * (14 - $i);
        }
        $resto = $soma % 11;
        $digito2 = ($resto < 2) ? 0 : 11 - $resto;

        // Verifica se os dígitos verificadores calculados coincidem com os do CNPJ
        if (intval($cnpj[12]) !== $digito1 || intval($cnpj[13]) !== $digito2) {
            return false;
        }

        return true;
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
            'cnpj.cnpj_validacao' => 'Este CNPJ não é valido',
        ];
    }
}
