<?php

namespace App\Http\Controllers\Maestro;

use App\Http\Controllers\Controller;
use App\Models\Inscripcion;

class InscripcionController extends Controller
{
    public function index()
    {
        $maestroId = auth()->id();

        $inscripciones = Inscripcion::with([
                'alumno',
                'curso'
            ])
            ->whereHas(
                'curso',
                function ($query)
                use ($maestroId) {

                    $query->where(
                        'instructor_id',
                        $maestroId
                    );
                }
            )
            ->latest()
            ->get();

        return view(
            'maestro.inscripciones.index',
            compact('inscripciones')
        );
    }

    public function aprobar(Inscripcion $inscripcion)
{
    $curso = $inscripcion->curso;

    $aprobados = $curso
        ->inscripciones()
        ->where(
            'estado',
            'Aprobado'
        )
        ->count();

    if(
        $aprobados
        >=
        $curso->cupo_maximo
    )
    {
        return back()->with(
            'error',
            'El curso ya alcanzó su cupo máximo.'
        );
    }

    $inscripcion->update([

        'estado' => 'Aprobado'

    ]);

    return back()->with(
        'success',
        'Inscripción aprobada.'
    );
}
public function rechazar(Inscripcion $inscripcion)
{
    $inscripcion->update([

        'estado' => 'Rechazado'

    ]);

    return back()->with(
        'success',
        'Inscripción rechazada.'
    );
}
public function darBaja(
    Inscripcion $inscripcion
)
{
    $inscripcion->update([

        'estado' => 'Baja'

    ]);

    $curso = $inscripcion->curso;

    $siguiente = $curso
        ->inscripciones()
        ->where(
            'estado',
            'Lista Espera'
        )
        ->orderBy(
            'fecha_inscripcion'
        )
        ->first();

    if($siguiente)
    {
        $siguiente->update([

            'estado' => 'Pendiente'

        ]);
    }

    return back()->with(
        'success',
        'Alumno dado de baja y se liberó un lugar.'
    );
}
}