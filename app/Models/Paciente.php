<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table = 'pacientes';

    protected $fillable = [
        'telefono',
        'calle',
        'numero_exterior',
        'fraccionamiento',
        'codigo_postal',
        'genero',
        'fecha_nacimiento',
        'user_id',
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

   
    public function citas()
    {
        return $this->hasMany(Cita::class, 'id_paciente');
    }
}