<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanoRequest extends FormRequest
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
    
        if ($this->isMethod('post')) {
            $rules['name'] = 'required|max:45|unique:tipo__produtos,name';
        }
    
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => "Este campo é obrigatório",
            'name.max' => "este campo não pode ser maior que 45 caracteres",
            'name.unique' => 'Já está em uso',

            'description.required' => "Este campo é obrigatório",
            'description.max' => "Este campo deve ter até 250 caracteres",
        ];
    }
}
