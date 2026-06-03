<?php

namespace App\Http\Controllers\Maestro;

use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Models\Inscripcion;

class InscripcionController extends Controller
{
    public function index()
    {
        $maestroId = auth()->id();

        $cursos = Curso::where('instructor_id', $maestroId)
            ->orderBy('titulo')
            ->get();

        $inscripciones = Inscripcion::with(['alumno', 'curso'])
            ->whereHas('curso', fn ($query) => $query->where('instructor_id', $maestroId))
            ->when(request('curso'), fn ($query) => $query->where('curso_id', request('curso')))
            ->when(request('estado'), fn ($query) => $query->where('estado', request('estado')))
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('maestro.inscripciones.index', compact('inscripciones', 'cursos'));
    }

    public function aprobar(Inscripcion $inscripcion)
    {
        $this->authorize('gestionar', $inscripcion);

        $curso = $inscripcion->curso;

        $aprobados = $curso->inscripciones()
            ->where('estado', 'Aprobado')
            ->count();

        if ($aprobados >= $curso->cupo_maximo) {
            return back()->with('error', 'El curso ya alcanzó su cupo máximo.');
        }

        $inscripcion->update(['estado' => 'Aprobado']);

        return back()->with('success', 'Inscripción aprobada.');
    }

    public function rechazar(Inscripcion $inscripcion)
    {
        $this->authorize('gestionar', $inscripcion);

        $inscripcion->update(['estado' => 'Rechazado']);

        return back()->with('success', 'Inscripción rechazada.');
    }

    public function darBaja(Inscripcion $inscripcion)
    {
        $this->authorize('gestionar', $inscripcion);

        $inscripcion->update(['estado' => 'Baja']);

        $curso = $inscripcion->curso;

        $siguiente = $curso->inscripciones()
            ->where('estado', 'Lista Espera')
            ->orderBy('fecha_inscripcion')
            ->first();

        if ($siguiente) {
            $siguiente->update(['estado' => 'Pendiente']);
        }

        return back()->with('success', 'Alumno dado de baja y se liberó un lugar.');
    }
}
