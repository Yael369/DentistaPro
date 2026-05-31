<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    protected $table = 'pagos';

    protected $fillable = [
        'id_cita',
        'monto',
        'fecha_pago'
    ];

    // Relación uno a uno con Cita
    public function cita()
    {
        return $this->belongsTo(Cita::class, 'id_cita');
    }
}
