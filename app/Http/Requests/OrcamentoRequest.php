<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrcamentoRequest extends FormRequest
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
            'description' => 'required|max:250',
            'response_observation' => 'max:250',
            'data_inicio_analise' => 'date',
            'data_previsao' => 'date',
            'data_encerramento' => 'date',
            'orcamento_status' => 'boolean',
            'cliente_id' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'description.required' => "Este campo é obrigatório",
            'description.max' => "Este campo deve ter no maximo 250 caracteres",

            'response_observation.max' => "Este campo deve ter no maximo 250 caracteres",

            'data_inicio_analise.date' => "Formato invalido",

            'data_previsao.date' => "Formato invalido",

            'data_encerramento.date' => "Formato invalido",

            'orcamento_status.boolean' => "Formato invalido",

            'cliente_id.required' => "Este campo é obrigatório",
            'cliente_id.numeric' => "Formato invalido",
        ];
    }
}
