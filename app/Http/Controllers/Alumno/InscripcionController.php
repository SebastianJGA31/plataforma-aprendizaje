<?php

namespace App\Http\Controllers\Alumno;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInscripcionRequest;
use App\Models\Curso;
use App\Models\Inscripcion;
use Illuminate\Support\Facades\Auth;

class InscripcionController extends Controller
{
    public function index()
    {
        $inscripciones = Inscripcion::with('curso')
            ->where('alumno_id', auth()->id())
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('alumno.inscripciones.index', compact('inscripciones'));
    }

    public function create(Curso $curso)
    {
        if (!$curso->estaDisponibleParaCarrera(Auth::user()->carrera_id)) {
            abort(403, 'No puedes inscribirte en este curso.');
        }

        return view('alumno.inscripciones.create', compact('curso'));
    }

    public function store(StoreInscripcionRequest $request, Curso $curso)
    {
        if (!$curso->estaDisponibleParaCarrera(Auth::user()->carrera_id)) {
            abort(403, 'No puedes inscribirte en este curso.');
        }

        $alumnoId = Auth::id();

        $yaInscrito = Inscripcion::where('alumno_id', $alumnoId)
            ->where('curso_id', $curso->id)
            ->whereIn('estado', Inscripcion::ESTADOS_ACTIVOS)
            ->exists();

        if ($yaInscrito) {
            return back()->with('error', 'Ya tienes una inscripción activa en este curso.');
        }

        $inscritosAprobados = $curso->inscripciones()
            ->where('estado', 'Aprobado')
            ->count();

        if ($inscritosAprobados >= $curso->cupo_maximo) {
            $estado = 'Lista Espera';
        } else {
            $estado = $curso->requiere_aprobacion ? 'Pendiente' : 'Aprobado';
        }

        Inscripcion::create([
            'alumno_id' => $alumnoId,
            'curso_id' => $curso->id,
            'motivo' => $request->motivo,
            'experiencia' => $request->experiencia,
            'estado' => $estado,
            'fecha_inscripcion' => now(),
        ]);

        $mensaje = match ($estado) {
            'Pendiente' => 'Solicitud enviada. Quedó pendiente de aprobación.',
            'Lista Espera' => 'El curso ya está lleno. Has sido agregado a la lista de espera.',
            default => 'Inscripción realizada correctamente.',
        };

        return redirect()
            ->route('alumno.inscripciones.index')
            ->with('success', $mensaje);
    }
}
