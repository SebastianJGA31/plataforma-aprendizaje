<?php

namespace App\Policies;

use App\Models\Curso;
use App\Models\User;

class CursoPolicy
{
    /**
     * Determina si el usuario puede ver el detalle de un curso.
     * Los Administradores siempre pueden. Un Maestro solo puede ver los suyos.
     */
    public function ver(User $user, Curso $curso): bool
    {
        if ($user->role->nombre === 'Administrador') {
            return true;
        }

        return $curso->instructor_id === $user->id;
    }

    /**
     * Determina si el usuario puede gestionar (editar) un curso.
     * Solo el Administrador puede editar cualquier curso.
     * Un Maestro no puede editar cursos (solo los gestiona el Admin).
     */
    public function gestionar(User $user, Curso $curso): bool
    {
        return $user->role->nombre === 'Administrador';
    }
}
