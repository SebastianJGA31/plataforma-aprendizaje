<?php

namespace App\Policies;

use App\Models\Inscripcion;
use App\Models\User;

class InscripcionPolicy
{
    /**
     * Determina si el usuario puede gestionar (aprobar, rechazar o dar de baja)
     * una inscripción. Solo el Maestro que imparte el curso asociado puede hacerlo.
     */
    public function gestionar(User $user, Inscripcion $inscripcion): bool
    {
        return $inscripcion->curso->instructor_id === $user->id;
    }
}
