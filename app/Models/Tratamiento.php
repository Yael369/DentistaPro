<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tratamiento extends Model
{
    protected $table = 'tratamientos';

    protected $fillable = [
        'nombre_tratamiento',
        'descripcion',
        'costo'
    ];

    // Relación muchos a muchos con Cita_tratamiento
    public function citas()
{
    return $this->belongsToMany(Cita::class, 'cita_tratamiento', 'id_tratamiento', 'id_cita');
}
}

