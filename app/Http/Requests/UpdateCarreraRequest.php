<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCarreraRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $carreraId = $this->route('carrera')->id;

        return [
            'nombre' => ['required', 'string', 'max:255', 'unique:carreras,nombre,' . $carreraId],
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre de la carrera es obligatorio.',
            'nombre.unique' => 'Esa carrera ya existe.',
        ];
    }
}
