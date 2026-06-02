<?php

namespace App\Http\Requests;

use App\Models\Role;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCursoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $rolMaestro = Role::where('nombre', 'Maestro')->value('id');

        return [
            'titulo' => ['required', 'max:255'],
            'descripcion' => ['required'],
            'tipo' => ['required'],
            'modalidad' => ['required'],
            'instructor_id' => [
                'required',
                Rule::exists('users', 'id')->where('rol_id', $rolMaestro),
            ],
            'cupo_maximo' => ['required', 'integer', 'min:1'],
            'fecha_inicio' => ['required', 'date'],
            'fecha_fin' => ['required', 'date', 'after:fecha_inicio'],
            'todas_las_carreras' => ['required_without:carreras', 'boolean'],
            'carreras' => ['required_without:todas_las_carreras', 'array', 'min:1'],
            'imagen' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.required' => 'El título es obligatorio.',
            'titulo.max' => 'El título no puede superar los 255 caracteres.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'tipo.required' => 'Debe seleccionar un tipo de evento.',
            'modalidad.required' => 'Debe seleccionar una modalidad.',
            'instructor_id.required' => 'Debe seleccionar un instructor.',
            'instructor_id.exists' => 'El instructor seleccionado debe ser un maestro válido.',
            'cupo_maximo.required' => 'Debe indicar el cupo.',
            'cupo_maximo.integer' => 'El cupo máximo debe ser un número entero.',
            'cupo_maximo.min' => 'El cupo debe ser mayor a 0.',
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_inicio.date' => 'La fecha de inicio debe ser una fecha válida.',
            'fecha_fin.required' => 'La fecha final es obligatoria.',
            'fecha_fin.date' => 'La fecha final debe ser una fecha válida.',
            'fecha_fin.after' => 'La fecha final debe ser posterior a la fecha inicial.',
            'todas_las_carreras.required_without' => 'Debe marcar "Disponible para todas las carreras" o seleccionar al menos una de la lista.',
            'carreras.required_without' => 'Debe seleccionar al menos una carrera o marcar la casilla de arriba.',
        ];
    }
}
