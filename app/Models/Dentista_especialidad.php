<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dentista_especialidad extends Model
{
    protected $table = 'dentista_especialidad';

    protected $fillable = [
        'id_dentista',
        'id_especialidad',
    ];

    // Relación con Dentista y Especialidad
    public function dentista()
    {
        return $this->belongsTo(Dentista::class);
    }

    // Relación con Especialidad
    public function especialidad()
    {
        return $this->belongsTo(Especialidad::class);
    }
}
