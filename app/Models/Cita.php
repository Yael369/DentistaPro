<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $fillable = [
        'id_paciente',
        'id_dentista',
        'fecha',
        'hora',
        'estado',
        'motivo',
    ];

    
    public function paciente()
    {
        return $this->belongsTo(Paciente::class, 'id_paciente');
    }

    public function dentista()
    {
        return $this->belongsTo(Dentista::class, 'id_dentista');
    }
    
  
    public function tratamientos()
    {
        return $this->belongsToMany(Tratamiento::class, 'cita_tratamiento', 'id_cita', 'id_tratamiento');
    }
    
  
    public function pago()
    {
        return $this->hasOne(Pago::class, 'id_cita');
    }
}