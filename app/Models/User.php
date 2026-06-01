<?php

namespace App\Models;

use App\Models\Curso;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;use App\Models\Role;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    public function role()
{
    return $this->belongsTo(Role::class, 'rol_id');
}

public function carrera()
{
    return $this->belongsTo(Carrera::class);
}
    protected $fillable = [
    'name',
    'numero_control',
    'email',
    'password',
    'rol_id',
    'carrera_id',
    'semestre',
    'telefono'
];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function cursos()
{
    return $this->hasMany(Curso::class, 'instructor_id');
}

public function inscripciones()
{
    return $this->hasMany(
        Inscripcion::class,
        'alumno_id'
    );
}
}
