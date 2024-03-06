<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdministradorRequest extends FormRequest
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
            'name' => 'required|max:45|regex:/^[\pL\s]+$/u',
            'email' => 'required|email|max:45',
            'password' => 'max:45|min:8|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
            'password_confirmation' => 'same:password'
        ];
    
        // Adiciona as regras de senha apenas se for um formulário de criação
        if ($this->isMethod('post')) {
            $rules['password'] = 'required|max:45|min:8|regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/';
            $rules['password_confirmation'] = 'required|same:password';
        }
    
        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => "O nome é obrigatório",
            'name.max' => "O nome não pode ser maior que 45 caracteres",
            'name.regex' => 'O nome deve conter apenas letras',

            'email.required' => "O e-mail é obrigatório",
            'email.email' => 'O e-mail deve ser um endereço de e-mail válido',
            'email.max' => "O e-mail não pode ser maior que 45 caracteres",

            'password.required' => "A senha é obrigatório",
            'password.max' => "O nome não pode ser maior que 45 caracteres",
            'password.min' => 'A senha deve ter no mínimo 8 caracteres',
            'password.regex' => 'A senha deve conter pelo menos uma letra maiúscula, uma letra minúscula, um número e um caractere especial',

            'password_confirmation.required' => 'A confirmação de senha é obrigatória',
            'password_confirmation.same' => 'A senha e a confirmação de senha devem ser iguais',
        ];
    }
}
