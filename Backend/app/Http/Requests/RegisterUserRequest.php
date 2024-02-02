<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'name'    => 'required|max:50',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:8',
        ];
    }


    public function messages(): array
    {
        return [
            'name.required'     => 'El campo nombre es obligatorio.',
            'name.max'          => 'El campo nombre no puede tener más de 50 caracteres.',
            'email.required'    => 'El campo email es obligatorio.',
            'email.email'       => 'El email debe ser una dirección de correo válida.',
            'email.unique'      => 'El email ya está registrado en el sistema.',
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.min'      => 'La contraseña debe tener al menos 8 caracteres.',
        ];
    }
}
