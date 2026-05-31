<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Paciente;
use App\Models\Dentista;
use App\Models\Cita;
use App\Models\Pago;
use App\Models\Especialidad;
use Carbon\Carbon;

class AdminDashboardComposerServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
       
        View::composer('dashboard.admin', function ($view) {
       
            $totalPacientes = Paciente::count();
            $totalDentistas = Dentista::count();
            $totalCitas = Cita::count();
            $totalTratamientos = \App\Models\Tratamiento::count();
            
            $citasHoy = Cita::whereDate('fecha', Carbon::today())->count();
            $citasPendientes = Cita::where('estado', 'pendiente')->count();
            $citasConfirmadas = Cita::where('estado', 'confirmada')->count();
            
            $nuevosPacientesMes = Paciente::whereMonth('created_at', Carbon::now()->month)->count();
            $citasPendientesHoy = Cita::whereDate('fecha', Carbon::today())->where('estado', 'pendiente')->count();
            
            $ingresosMes = Pago::whereYear('fecha_pago', Carbon::now()->year)
                ->whereMonth('fecha_pago', Carbon::now()->month)
                ->sum('monto');
            
            $especialidadesCount = Especialidad::count();
            
            $proximasCitas = Cita::with(['paciente.user', 'dentista.user'])
                ->whereDate('fecha', '>=', Carbon::today())
                ->where('estado', 'pendiente')
                ->orderBy('fecha', 'asc')
                ->orderBy('hora', 'asc')
                ->take(5)
                ->get();
            
            $pacientesRecientes = Paciente::with('user')->latest()->take(5)->get();
            $ultimosPacientes = Paciente::with('user')->latest()->take(5)->get();
            $ultimasCitas = Cita::with(['paciente.user', 'dentista.user'])->latest()->take(5)->get();
            
          
            $diasSemana = [];
            $citasPorDia = [];
            for ($i = 6; $i >= 0; $i--) {
                $fecha = Carbon::today()->subDays($i);
                $diasSemana[] = $fecha->locale('es')->isoFormat('dddd');
                $citasPorDia[] = Cita::whereDate('fecha', $fecha)->count();
            }
            
            $ingresosMesAnterior = Pago::whereYear('fecha_pago', Carbon::now()->year)
                ->whereMonth('fecha_pago', Carbon::now()->subMonth()->month)
                ->sum('monto');
            
            $porcentajeIngresos = 0;
            if ($ingresosMesAnterior > 0) {
                $porcentajeIngresos = round((($ingresosMes - $ingresosMesAnterior) / $ingresosMesAnterior) * 100, 1);
            }
            
            $view->with(compact(
                'totalDentistas', 'totalPacientes', 'totalCitas', 'totalTratamientos',
                'citasHoy', 'citasPendientes', 'citasConfirmadas',
                'nuevosPacientesMes', 'citasPendientesHoy', 'ingresosMes',
                'especialidadesCount', 'proximasCitas', 'pacientesRecientes',
                'diasSemana', 'citasPorDia', 'ultimosPacientes', 'ultimasCitas', 'porcentajeIngresos'
            ));
        });
    }

    public function register(): void
    {
      
    }
}