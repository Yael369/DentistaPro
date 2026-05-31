<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Horario_Disponible extends Model
{
    protected $table = 'horarios_disponibles';

    protected $fillable = [
        'id_dentista',
        'dia_semana',
        'hora_inicio',
        'hora_fin'
    ];

    // Relación con Dentista
    public function dentista()
    {
        return $this->belongsTo(Dentista::class);
    }
}
