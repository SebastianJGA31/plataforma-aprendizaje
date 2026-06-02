<?php

namespace App\Http\Controllers\Maestro;

use App\Http\Controllers\Controller;
use App\Models\Curso;

class CursoController extends Controller
{
    public function index()
    {
        $cursos = Curso::withCount([
                'inscripciones as pendientes_count' => fn ($q) => $q->where('estado', 'Pendiente'),
                'inscripciones as aprobados_count' => fn ($q) => $q->where('estado', 'Aprobado'),
                'inscripciones as lista_espera_count' => fn ($q) => $q->where('estado', 'Lista Espera'),
            ])
            ->where('instructor_id', auth()->id())
            ->latest()
            ->get();

        return view('maestro.cursos.index', compact('cursos'));
    }
}
