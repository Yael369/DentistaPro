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
        Schema::create('cita_tratamiento', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_cita')->constrained('citas')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('id_tratamiento')->constrained('tratamientos')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cita_tratamiento');
    }
};
