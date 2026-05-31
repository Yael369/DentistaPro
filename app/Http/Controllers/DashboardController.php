<?php

namespace App\Http\Controllers;

use App\Models\Cita;
use App\Models\Tratamiento;
use App\Models\Pago;
use App\Models\Paciente;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        
        if ($user->rol === 'dentista') {
            return redirect()->route('dentista.dashboard');
        }

        if ($user->rol === 'admin') {
            return view('dashboard');    
        }

        if ($user->rol === 'paciente') {
            $paciente = $user->paciente;
            
            if (!$paciente) {
                return redirect()->route('paciente.register')
                    ->with('warning', 'Por favor completa tu registro para acceder al dashboard.');
            }

            $miembro_desde = $user->created_at->format('M Y');

       
            $citas = Cita::where('id_paciente', $paciente->id)
                ->where('estado', 'confirmada')
                ->count();

            $proxima_cita = Cita::with(['dentista.user'])
                ->where('id_paciente', $paciente->id)
                ->where('estado', 'pendiente')
                ->whereDate('fecha', '>=', Carbon::today())
                ->orderBy('fecha', 'asc')
                ->orderBy('hora', 'asc')
                ->first();

  
            $tratamientos_realizados = Tratamiento::whereHas('citas', function ($q) use ($paciente) {
                $q->where('id_paciente', $paciente->id)
                  ->where('estado', 'confirmada');
            })->count();


            $ultimas_atenciones = Cita::with(['dentista.user', 'tratamientos'])
                ->where('id_paciente', $paciente->id)
                ->where('estado', 'confirmada')
                ->orderBy('fecha', 'desc')
                ->orderBy('hora', 'desc')
                ->take(5)
                ->get();


            $proximas_citas = Cita::with(['dentista.user'])
                ->where('id_paciente', $paciente->id)
                ->where('estado', 'pendiente')
                ->whereDate('fecha', '>=', Carbon::today())
                ->orderBy('fecha', 'asc')
                ->orderBy('hora', 'asc')
                ->take(5)
                ->get();


            $pagos = Pago::whereHas('cita', function ($q) use ($paciente) {
                $q->where('id_paciente', $paciente->id);
            })
            ->orderBy('fecha_pago', 'desc')
            ->take(5)
            ->get();

  
            $total_pagado_anio = Pago::whereHas('cita', function ($q) use ($paciente) {
                $q->where('id_paciente', $paciente->id);
            })
            ->whereYear('fecha_pago', Carbon::now()->year)
            ->sum('monto');

            return view('dashboard', compact(
                'miembro_desde',
                'citas',
                'proxima_cita',
                'tratamientos_realizados',
                'ultimas_atenciones',
                'proximas_citas',
                'pagos',
                'total_pagado_anio'
            ));
        }
        
        return view('dashboard');
    }
}