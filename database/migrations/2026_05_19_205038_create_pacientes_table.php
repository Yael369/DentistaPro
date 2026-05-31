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
        Schema::create('pacientes', function (Blueprint $table) {
            $table->id();
            $table->string('telefono', 11);
            $table->string('calle');
            $table->integer('numero_exterior');
            $table->string('fraccionamiento');
            $table->integer('codigo_postal');
            $table->enum('genero', ['masculino', 'femenino', 'Sin especificar']);
            $table->dateTime('fecha_nacimiento');
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();

            //Campo unico
            $table->unique('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pacientes');
    }
};
