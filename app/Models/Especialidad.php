<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Especialidad extends Model
{
    protected $table = 'especialidades';

    protected $fillable = [
        'nombre_especialidad',
        'descripcion'
    ];

    // Relación muchos a muchos con Dentista
    public function dentistas()
    {
        return $this->belongsToMany(Dentista::class, 'dentista_especialidad', 'id_especialidad', 'id_dentista');
    }
}
