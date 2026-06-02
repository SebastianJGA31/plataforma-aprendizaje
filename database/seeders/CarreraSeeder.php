<?php

namespace Database\Seeders;

use App\Models\Carrera;
use Illuminate\Database\Seeder;

class CarreraSeeder extends Seeder
{
    public function run(): void
    {
        $carreras = [
            'Ingeniería en Sistemas',
            'Ingeniería Industrial',
            'Ingeniería Mecatrónica',
            'Ingeniería Civil',
            'Gestión Empresarial',
        ];

        foreach ($carreras as $carrera) {
            Carrera::firstOrCreate(['nombre' => $carrera]);
        }
    }
}
