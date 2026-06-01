<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up(): void
{
    Schema::create('cursos', function (Blueprint $table) {

        $table->id();

        $table->string('titulo');

        $table->text('descripcion');

        $table->enum('tipo', [
            'Curso',
            'Taller',
            'Conferencia',
            'Webinar'
        ]);

        $table->enum('modalidad', [
            'Presencial',
            'Virtual',
            'Hibrida'
        ]);

        $table->enum('tipo_origen', [
            'Interno',
            'Externo'
        ]);

        $table->foreignId('instructor_id')
              ->constrained('users');

        $table->integer('cupo_maximo');

        $table->date('fecha_inicio');

        $table->date('fecha_fin');

        $table->string('lugar')->nullable();

        $table->string('enlace_externo')->nullable();

        $table->boolean('requiere_aprobacion')
              ->default(false);

        $table->boolean('permite_resenas')
              ->default(true);

        $table->enum('estado', [
            'Activo',
            'Cerrado',
            'Finalizado',
            'Cancelado'
        ])->default('Activo');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cursos');
    }
};
