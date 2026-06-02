<?php

namespace App\Http\Requests;

use App\Models\Role;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCursoRequest extends FormRequest
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
            'lugar' => ['required'],
            'instructor_id' => [
                'required',
                Rule::exists('users', 'id')->where('rol_id', $rolMaestro),
            ],
            'cupo_maximo' => ['required', 'integer', 'min:1'],
            'fecha_inicio' => ['required', 'date', 'after_or_equal:today'],
            'fecha_fin' => ['required', 'date', 'after_or_equal:fecha_inicio'],
            'todas_las_carreras' => ['required_without:carreras', 'boolean'],
            'carreras' => ['required_without:todas_las_carreras', 'array', 'min:1'],
            'imagen' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'titulo.required' => 'El título es obligatorio.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'instructor_id.required' => 'Debe seleccionar un instructor.',
            'instructor_id.exists' => 'El instructor seleccionado debe ser un maestro válido.',
            'cupo_maximo.required' => 'Debe indicar el cupo.',
            'cupo_maximo.min' => 'El cupo debe ser mayor a 0.',
            'fecha_inicio.after_or_equal' => 'La fecha de inicio no puede ser anterior a hoy.',
            'fecha_fin.after_or_equal' => 'La fecha final debe ser igual o posterior a la fecha inicial.',
            'todas_las_carreras.required_without' => 'Debe marcar "Disponible para todas las carreras" o seleccionar al menos una de la lista.',
            'carreras.required_without' => 'Debe seleccionar al menos una carrera o marcar la casilla de arriba.',
        ];
    }
}
