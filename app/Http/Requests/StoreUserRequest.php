<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

   
    public function rules(): array
    {
        return [

            'name' => [
                'required',
                'max:255',
                'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ ]+$/'
            ],

            'numero_control' => [
                'required',
                'numeric',
                'digits:8',
                'unique:users'
            ],

            'email' => [
                'required',
                'email',
                'unique:users'
            ],

            'password' => [
                'required',
                'min:6'
            ],

            'rol_id' => [
                'required'
            ],

            'carrera_id' => [
                'required_if:rol_id,3',
                'nullable',
                'exists:carreras,id',
            ],

            'semestre' => [
                    'required_if:rol_id,3',
                    'nullable',
                'integer',
                'between:1,14'
            ],

            'telefono' => [
                'required',
                'numeric',
                'digits:10'
            ]

        ];
    }

    public function messages(): array
    {
        return [

            'name.required' => 'El nombre es obligatorio.',
            'name.max' => 'El nombre no puede superar los 255 caracteres.',
            'name.regex' => 'El nombre solo puede contener letras.',

            'numero_control.required' => 'El número de control es obligatorio.',
            'numero_control.numeric' => 'El número de control debe contener solo números.',
            'numero_control.digits' => 'El número de control debe tener exactamente 8 dígitos.',
            'numero_control.unique' => 'Ese número de control ya existe.',

            'email.required' => 'El correo es obligatorio.',
            'email.email' => 'Debe ingresar un correo electrónico válido.',
            'email.unique' => 'Ese correo ya existe.',

            'password.required' => 'La contraseña es obligatoria.',
            'password.min' => 'La contraseña debe tener mínimo 6 caracteres.',

            'rol_id.required' => 'Debe seleccionar un rol para el usuario.',

            'carrera_id.required_if' => 'La carrera es obligatoria para alumnos.',
            'carrera_id.exists' => 'La carrera seleccionada no es válida.',

            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.numeric' => 'El teléfono debe contener solo números.',
            'telefono.digits' => 'El teléfono debe tener exactamente 10 dígitos.',

            'semestre.required_if' => 'El semestre es obligatorio para alumnos.',
            'semestre.integer' => 'El semestre debe ser un número entero.',

        ];
    }
}
