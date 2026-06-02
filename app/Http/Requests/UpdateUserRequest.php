<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; 
    }

    
    public function rules(): array
    {
        $parametro = $this->route('usuario');
        $usuarioId = is_object($parametro) ? $parametro->id : $parametro;

        return [
            'name'           => ['required', 'string', 'max:255'],
            'rol_id'         => ['required', 'exists:roles,id'],
            
            'numero_control' => ['required', 'string', 'max:50', 'unique:users,numero_control,' . $usuarioId],
            'email'          => ['required', 'email', 'max:255', 'unique:users,email,' . $usuarioId],
            
            'carrera_id'     => ['nullable', 'exists:carreras,id'],
            'semestre'       => ['nullable', 'integer', 'min:1', 'max:12'],
            'telefono'       => ['nullable', 'string', 'max:20'],
            
            'password'       => ['nullable', 'string', 'min:8'],
        ];
    }

    
    public function messages(): array
    {
        return [
            'name.required'           => 'El nombre es obligatorio.',
            'rol_id.required'         => 'Debes seleccionar un rol para el usuario.',
            'rol_id.exists'           => 'El rol seleccionado no es válido.',
            'numero_control.required' => 'El número de control es obligatorio.',
            'numero_control.unique'   => 'Este número de control ya está asignado a otro usuario.',
            'email.required'          => 'El correo electrónico es obligatorio.',
            'email.email'             => 'El formato del correo no es válido.',
            'email.unique'            => 'Este correo electrónico ya está registrado por otro usuario.',
            'carrera_id.exists'       => 'La carrera seleccionada no existe.',
            'semestre.integer'        => 'El semestre debe ser un número entero.',
            'password.min'            => 'Si vas a cambiar la contraseña, debe tener al menos 8 caracteres.',
        ];
    }
}