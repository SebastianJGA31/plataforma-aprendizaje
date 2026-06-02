<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterAlumnoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'max:255', 'regex:/^[A-Za-zÁÉÍÓÚáéíóúÑñ ]+$/'],
            'numero_control' => ['required', 'numeric', 'digits:8', 'unique:users'],
            'email' => ['required', 'email', 'unique:users'],
            'password' => ['required', 'confirmed', 'min:6'],
            'carrera_id' => ['required', 'exists:carreras,id'],
            'semestre' => ['required', 'integer', 'between:1,14'],
            'telefono' => ['required', 'numeric', 'digits:10'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es obligatorio.',
            'name.regex' => 'El nombre solo puede contener letras.',
            'numero_control.required' => 'El número de control es obligatorio.',
            'numero_control.digits' => 'El número de control debe tener exactamente 8 dígitos.',
            'numero_control.unique' => 'Ese número de control ya existe.',
            'email.required' => 'El correo es obligatorio.',
            'email.unique' => 'Ese correo ya existe.',
            'password.required' => 'La contraseña es obligatoria.',
            'password.confirmed' => 'Las contraseñas no coinciden.',
            'password.min' => 'La contraseña debe tener mínimo 6 caracteres.',
            'carrera_id.required' => 'Debe seleccionar una carrera.',
            'carrera_id.exists' => 'La carrera seleccionada no es válida.',
            'semestre.required' => 'El semestre es obligatorio.',
            'semestre.between' => 'El semestre debe estar entre 1 y 14.',
            'telefono.required' => 'El teléfono es obligatorio.',
            'telefono.digits' => 'El teléfono debe tener exactamente 10 dígitos.',
        ];
    }
}
