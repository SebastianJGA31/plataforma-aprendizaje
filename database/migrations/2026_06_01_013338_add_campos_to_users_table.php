<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
{
    Schema::table('users', function (Blueprint $table) {

        $table->string('numero_control')->unique()->after('name');

        $table->foreignId('rol_id')
            ->after('email')
            ->constrained('roles');

        $table->foreignId('carrera_id')
            ->nullable()
            ->constrained('carreras');

        $table->integer('semestre')->nullable();

        $table->string('telefono')->nullable();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
{
    Schema::table('users', function (Blueprint $table) {

        $table->dropForeign(['rol_id']);
        $table->dropForeign(['carrera_id']);

        $table->dropColumn([
            'numero_control',
            'rol_id',
            'carrera_id',
            'semestre',
            'telefono'
        ]);
    });
}
};
