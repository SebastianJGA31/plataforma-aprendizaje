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

    public function scopeDisponibleParaCarrera($query, ?int $carreraId)
    {
        return $query
            ->where('estado', 'Activo')
            ->where(function ($q) use ($carreraId) {
                $q->where('todas_las_carreras', true)
                    ->orWhereHas(
                        'carreras',
                        fn ($c) => $c->where('carreras.id', $carreraId)
                    );
            });
    }

    public function estaDisponibleParaCarrera(?int $carreraId): bool
    {
        if ($this->estado !== 'Activo') {
            return false;
        }

        if ($this->todas_las_carreras) {
            return true;
        }

        if (!$carreraId) {
            return false;
        }

        return $this->carreras()->where('carreras.id', $carreraId)->exists();
    }

    public function cuposDisponibles(): int
    {
        $aprobados = $this->inscripciones()
            ->where('estado', 'Aprobado')
            ->count();

        return max(0, $this->cupo_maximo - $aprobados);
    }
}