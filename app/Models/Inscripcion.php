<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inscripcion extends Model
{
    public const ESTADOS_ACTIVOS = [
        'Pendiente',
        'Aprobado',
        'Lista Espera',
    ];

    protected $table = 'inscripciones';

    protected $fillable = [
        'alumno_id',
        'curso_id',
        'estado',
        'fecha_inscripcion',
        'motivo',
        'experiencia',
    ];

    protected function casts(): array
    {
        return [
            'fecha_inscripcion' => 'datetime',
        ];
    }

    public function alumno()
{
    return $this->belongsTo(
        User::class,
        'alumno_id'
    );
}

public function curso()
{
    return $this->belongsTo(
        Curso::class,
        'curso_id'
    );
}
}