<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // 🚨 IMPORTANTE: Cambiado a true para que Laravel te permita usarlo
        return true; 
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        // Captura el parámetro 'usuario' de la URL de forma segura
        $parametro = $this->route('usuario');
        $usuarioId = is_object($parametro) ? $parametro->id : $parametro;

        return [
            'name'           => ['required', 'string', 'max:255'],
            'rol_id'         => ['required', 'exists:roles,id'],
            
            // Validamos que sean únicos en la tabla 'users' pero IGNORANDO al usuario actual ($usuarioId)
            'numero_control' => ['required', 'string', 'max:50', 'unique:users,numero_control,' . $usuarioId],
            'email'          => ['required', 'email', 'max:255', 'unique:users,email,' . $usuarioId],
            
            // Campos opcionales dependiendo del rol
            'carrera_id'     => ['nullable', 'exists:carreras,id'],
            'semestre'       => ['nullable', 'integer', 'min:1', 'max:12'],
            'telefono'       => ['nullable', 'string', 'max:20'],
            
            // La contraseña es 'nullable'. Si va vacía no pasa nada; si escriben algo, pide mínimo 8 caracteres.
            'password'       => ['nullable', 'string', 'min:8'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
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