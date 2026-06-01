<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCursoRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    
    public function rules(): array
{
    return [

        'titulo' => [
            'required',
            'max:255'
        ],

        'descripcion' => [
            'required'
        ],

        'tipo' => [
            'required'
        ],

        'modalidad' => [
            'required'
        ],

        'lugar' => [
            'required'
        ],

        'instructor_id' => [
            'required'
        ],

        'cupo_maximo' => [
            'required',
            'integer',
            'min:1'
        ],

        'fecha_inicio' => [
            'required',
            'date',
            'after_or_equal:today'
        ],

        'fecha_fin' => [
                'required',
                'date',
                'after_or_equal:fecha_inicio' // 🚨 Cambiado para permitir el mismo día o posterior
            ],
            
            // Validación cruzada de carreras que agregamos hace un momento
            'todas_las_carreras' => ['required_without:carreras', 'boolean'],
            'carreras' => ['required_without:todas_las_carreras', 'array', 'min:1'],
    ];
}

public function messages(): array
{
    return [

        'titulo.required' =>
            'El título es obligatorio.',

        'descripcion.required' =>
            'La descripción es obligatoria.',

        'instructor_id.required' =>
            'Debe seleccionar un instructor.',

        'cupo_maximo.required' =>
            'Debe indicar el cupo.',

        'cupo_maximo.min' =>
            'El cupo debe ser mayor a 0.',

        'fecha_inicio.after_or_equal' =>
            'La fecha de inicio no puede ser anterior a hoy.',

        'fecha_fin.after_or_equal' => // 🚨 Mensaje actualizado acorde a la nueva regla
                'La fecha final debe ser igual o posterior a la fecha inicial.',
                
            'todas_las_carreras.required_without' => 
                'Debe marcar "Disponible para todas las carreras" o seleccionar al menos una de la lista.',
                
            'carreras.required_without' => 
                'Debe seleccionar al menos una carrera o marcar la casilla de arriba.',
        ];

}
}
