<?php

namespace App\Http\Controllers\Alumno;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Curso;

class CursoController extends Controller
{
    public function index()
    {
        $carreraId =
$carreraId = Auth::user()->carrera_id;
        $cursos = Curso::with([
                'instructor',
                'carreras'
            ])
            ->where(function ($query)
                use ($carreraId) {

                $query->where(
                    'todas_las_carreras',
                    true
                )

                ->orWhereHas(
                    'carreras',
                    function ($q)
                    use ($carreraId) {

                        $q->where(
                            'carreras.id',
                            $carreraId
                        );
                    }
                );
            })
            ->where(
                'estado',
                'Activo'
            )
            ->get();

return view('alumno.index', compact('cursos')); // 🚨 Quitamos el ".cursos"
    }
}