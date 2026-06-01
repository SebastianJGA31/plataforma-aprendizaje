<?php

namespace App\Http\Controllers\Alumno;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Curso;
use App\Models\Inscripcion;
use Illuminate\Http\Request;

class InscripcionController extends Controller
{
    public function index()
{
    // Asegúrate de pasar primero el nombre de la columna entre comillas, y luego el ID
    $inscripciones = Inscripcion::with('curso')
        ->where('alumno_id', auth()->id()) // 👈 Column: 'alumno_id', Value: auth()->id()
        ->latest()
        ->get();

    return view('alumno.inscripciones.index', compact('inscripciones'));
}


    public function create(Curso $curso)
{
    return view(
        'alumno.inscripciones.create',
        compact('curso')
    );
}

public function store(
    Request $request,
    Curso $curso
)
{
                $alumnoId = Auth::id();


    $yaInscrito = Inscripcion::where(
            'alumno_id',
            $alumnoId
        )
        ->where(
            'curso_id',
            $curso->id
        )
        ->exists();

    if ($yaInscrito)
    {
        return back()->with(
            'error',
            'Ya estás inscrito en este curso.'
        );
    }

    $inscritosAprobados =
        $curso->inscripciones()
            ->where(
                'estado',
                'Aprobado'
            )
            ->count();

    if (
        $inscritosAprobados
        >=
        $curso->cupo_maximo
    )
    {
        $estado =
            'Lista Espera';
    }
    else
    {
        $estado =
            $curso->requiere_aprobacion
            ? 'Pendiente'
            : 'Aprobado';
    }

    Inscripcion::create([

        'alumno_id' =>
            $alumnoId,

        'curso_id' =>
            $curso->id,

        'motivo' =>
            $request->motivo,

        'experiencia' =>
            $request->experiencia,

        'estado' =>
            $estado,

        'fecha_inscripcion' =>
            now()

    ]);

    if($estado == 'Pendiente')
    {
        $mensaje =
            'Solicitud enviada. Quedó pendiente de aprobación.';
    }
    elseif($estado == 'Lista Espera')
    {
        $mensaje =
            'El curso ya está lleno. Has sido agregado a la lista de espera.';
    }
    else
    {
        $mensaje =
            'Inscripción realizada correctamente.';
    }

    return redirect()
        ->route(
            'alumno.inscripciones.index'
        )
        ->with(
            'success',
            $mensaje
        );
}
}
