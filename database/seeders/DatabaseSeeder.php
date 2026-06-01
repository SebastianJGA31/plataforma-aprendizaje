<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
{
    $this->call([
        RoleSeeder::class,
        CarreraSeeder::class,
    ]);
    
    User::create([
    'name' => 'Administrador',
    'numero_control' => 'ADMIN001',
    'email' => 'admin@plataforma.com',
    'password' => Hash::make('admin123'),
    'rol_id' => 1
]);
}


}
