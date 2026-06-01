<?php

namespace App\Models;
use App\Models\Carrera;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Curso extends Model
{
    use HasFactory;

    protected $fillable = [
        'titulo',
        'descripcion',
        'tipo',
        'modalidad',
        'tipo_origen',
        'instructor_id',
        'cupo_maximo',
        'fecha_inicio',
        'fecha_fin',
        'lugar',
        'enlace_externo',
        'requiere_aprobacion',
        'permite_resenas',
        'todas_las_carreras',
        'imagen',
        'estado'
    ];

    public function instructor()
    {
        return $this->belongsTo(User::class, 'instructor_id');
    }

    public function carreras()
{
    return $this->belongsToMany(
        Carrera::class,
        'carrera_curso'
    );
}

public function inscripciones()
{
    return $this->hasMany(
        Inscripcion::class
    );
}
}