<?php

namespace App\Models;

use App\Models\Curso;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Carrera extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
  
public function cursos()
{
    return $this->belongsToMany(
        Curso::class,
        'carrera_curso'
    );
}
}
