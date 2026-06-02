<?php

namespace App\Http\Controllers\Alumno;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use Illuminate\Support\Facades\Auth;

class CursoController extends Controller
{
    public function index()
    {
        $carreraId = Auth::user()->carrera_id;

        $cursos = Curso::with(['instructor', 'carreras'])
            ->withCount([
                'inscripciones as aprobados_count' => fn ($q) => $q->where('estado', 'Aprobado'),
            ])
            ->disponibleParaCarrera($carreraId)
            ->get();

        return view('alumno.index', compact('cursos'));
    }

    public function show(Curso $curso)
    {
        if (!$curso->estaDisponibleParaCarrera(Auth::user()->carrera_id)) {
            abort(403, 'No tienes acceso a este curso.');
        }

        $curso->load(['instructor', 'carreras']);

        return view('alumno.show', compact('curso'));
    }
}
