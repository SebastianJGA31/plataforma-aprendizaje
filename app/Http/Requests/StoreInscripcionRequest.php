<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreInscripcionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'motivo' => ['required', 'string', 'max:1000'],
            'experiencia' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'motivo.required' => 'Debe indicar el motivo de su inscripción.',
            'motivo.max' => 'El motivo no puede superar los 1000 caracteres.',
            'experiencia.max' => 'La experiencia no puede superar los 1000 caracteres.',
        ];
    }
}
