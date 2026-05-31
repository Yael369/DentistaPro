<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dentista extends Model
{
    protected $table = 'dentistas';

    protected $fillable = [
        'telefono',
        'user_id',
    ];
    
    // Relación uno a uno con User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relación uno a muchos con Cita    
    public function citas()
    {
        return $this->hasMany(Cita::class, 'id_dentista');
    }

    // Relación muchos a muchos con Especialidad
    public function especialidades()
    {
        return $this->belongsToMany(Especialidad::class, 'dentista_especialidad', 'id_dentista', 'id_especialidad');
    }

    // Relación uno a muchos con Horario
    public function horarios()
    {
        return $this->hasMany(Horario::class, 'id_dentista');
    }
}
