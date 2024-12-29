<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UsersRequest extends FormRequest
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
        // Validações
        return [
            'id_type' => 'required', 
            'name' => 'required|min:8',
            'email' => 'required|min:12|unique:users',
            'password' => 'required|min:8'
        ];
    }

    public function messages()
    {
        // Mensagens de erro (Email e Nome)
        return [
            'email.required' => 'email inválido',
            'email.min' => 'email deve conter pelo menos 12 caracteres',
            'name' => 'name inválido',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        // Buscando todos os erros
        $errors = $validator->errors()->toArray();

        // Formatando o array
        $map = array_map(fn($error) => $error, $errors);

        // Retornando o array formatado
        throw new HttpResponseException(response()->json($map, 422));
    }   
}
