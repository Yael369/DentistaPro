<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita_tratamiento extends Model
{
    protected $table = 'cita_tratamiento';

    protected $fillable = [
        'id_cita',
        'id_tratamiento',
    ];

    // Relación con Cita y Tratamiento
    public function cita()
    {
        return $this->belongsTo(Cita::class,'cita_tratamiento', 'id_cita', 'id_tratamiento');
    }

    // Relación muchos a muchos con Tratamiento
public function tratamientos()
{
    return $this->belongsToMany(Tratamiento::class, 'cita_tratamiento', 'id_cita', 'id_tratamiento');
}
}
