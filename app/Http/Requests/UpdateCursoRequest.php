<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCursoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // 🚨 MUY IMPORTANTE: Cambiado a true para que Laravel te permita usarlo
        return true; 
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'titulo' => ['required', 'max:255'],
            'descripcion' => ['required'],
            'tipo' => ['required'],
            'modalidad' => ['required'],
            'instructor_id' => ['required'],
            'cupo_maximo' => ['required', 'integer', 'min:1'],
            
            // 🔓 Fechas libres (sin el 'after_or_equal:today') para poder editar libremente
            'fecha_inicio' => ['required', 'date'], 
            'fecha_fin' => ['required', 'date', 'after:fecha_inicio'],

            // 🔀 Validación cruzada de carreras
            'todas_las_carreras' => ['required_without:carreras', 'boolean'],
            'carreras' => ['required_without:todas_las_carreras', 'array', 'min:1'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'titulo.required' => 'El título es obligatorio.',
            'titulo.max' => 'El título no puede superar los 255 caracteres.',
            'descripcion.required' => 'La descripción es obligatoria.',
            'tipo.required' => 'Debe seleccionar un tipo de evento.',
            'modalidad.required' => 'Debe seleccionar una modalidad.',
            'instructor_id.required' => 'Debe seleccionar un instructor.',
            'cupo_maximo.required' => 'Debe indicar el cupo.',
            'cupo_maximo.integer' => 'El cupo máximo debe ser un número entero.',
            'cupo_maximo.min' => 'El cupo debe ser mayor a 0.',
            'fecha_inicio.required' => 'La fecha de inicio es obligatoria.',
            'fecha_inicio.date' => 'La fecha de inicio debe ser una fecha válida.',
            'fecha_fin.required' => 'La fecha final es obligatoria.',
            'fecha_fin.date' => 'La fecha final debe ser una fecha válida.',
            'fecha_fin.after' => 'La fecha final debe ser posterior a la fecha inicial.',
            
            // Mensajes para las carreras
            'todas_las_carreras.required_without' => 'Debe marcar "Disponible para todas las carreras" o seleccionar al menos una de la lista.',
            'carreras.required_without' => 'Debe seleccionar al menos una carrera o marcar la casilla de arriba.',
        ];
    }
}