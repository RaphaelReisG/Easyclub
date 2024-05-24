<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TipoOrcamentoRequest extends FormRequest
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
            //'name' => 'required|max:45|unique:tipo_orcamentos',
            'name' => 'required|max:45',
            'description' => 'required|max:250'
        ];
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => "O nome é obrigatório",
            'name.max' => "O nome não pode ser maior que 45 caracteres",
            'name.unique' => 'Este Nome já está em uso',

            'description.required' => "Este campo é obrigatório",
            'description.max' => "Este campo não pode ter mais que 250 caracteres",
        ];
    }
}
