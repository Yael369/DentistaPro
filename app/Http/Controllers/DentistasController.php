<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Cita;
use App\Models\Paciente;
use App\Models\Tratamiento;

use Carbon\Carbon;

class DentistasController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $dentista = $user->dentista;

        $citasHoy = Cita::where('id_dentista', $dentista->id)
            ->whereDate('fecha', Carbon::today())
            ->count();

        $citasPendientes = Cita::where('id_dentista', $dentista->id)
            ->where('estado', 'pendiente')
            ->whereDate('fecha', Carbon::today())
            ->count();

        $pacientesAtendidos = Cita::where('id_dentista', $dentista->id)
            ->where('estado', 'confirmada')
            ->distinct('id_paciente')
            ->count('id_paciente');

        $tratamientosRealizados = Tratamiento::whereHas('citas', function ($query) use ($dentista) {
            $query->where('id_dentista', $dentista->id)
                  ->where('estado', 'confirmada');})->count();

        $proximaCita = Cita::with('paciente')
            ->where('id_dentista', $dentista->id)
            ->whereDate('fecha', '>=', Carbon::today())
            ->where('estado', 'pendiente')
            ->orderBy('fecha')
            ->orderBy('hora')
            ->first();

        $agendaHoy = Cita::with('paciente')
            ->where('id_dentista', $dentista->id)
            ->whereDate('fecha', Carbon::today())
            ->orderBy('hora')
            ->get();

        $ultimosPacientes = Paciente::latest()
            ->take(5)
            ->get();

        $proximosTratamientos = Tratamiento::whereHas('citas', function ($query) use ($dentista) {
        $query->where('id_dentista', $dentista->id)
          ->where('estado', 'pendiente');})
        ->withCount(['citas as pacientes_pendientes' => function ($query) use ($dentista) {
        $query->where('id_dentista', $dentista->id)->where('estado', 'pendiente');}])
        ->take(4)
        ->get();

        return view('dashboard', compact(
            'citasHoy',
            'citasPendientes',
            'pacientesAtendidos',
            'tratamientosRealizados',
            'proximaCita',
            'agendaHoy',
            'ultimosPacientes',
            'proximosTratamientos'
        ));
        
    }

public function misCitas()
{
    $dentista = auth()->user()->dentista;

    $citas = Cita::with('paciente.user')
        ->where('id_dentista', $dentista->id)
        ->orderBy('fecha', 'asc')
        ->orderBy('hora', 'asc')
        ->get();

    return view('dentista.citas', compact('citas'));
}

public function pacientes()
{
    $dentista = auth()->user()->dentista;
    
    $pacientes = Paciente::with('user')
        ->whereHas('citas', function ($query) use ($dentista) {
            $query->where('id_dentista', $dentista->id);
        })
        ->latest()
        ->paginate(10);
    
    return view('dentista.pacientes', compact('pacientes'));
}


public function consultas()
{
    $dentista = auth()->user()->dentista;
    

    $tratamientos = Tratamiento::whereHas('citas', function ($query) use ($dentista) {
        $query->where('id_dentista', $dentista->id)
              ->where('estado', 'confirmada'); 
    })
    ->with(['citas' => function ($query) use ($dentista) {
        $query->where('id_dentista', $dentista->id)
              ->where('estado', 'confirmada');
    }])
    ->latest()
    ->paginate(10);
    
    return view('dentista.consultas', compact('tratamientos'));
}


public function historialIndex()
{
    return view('dentista.historial-index');
}


public function buscarPacientes(Request $request)
{
    $dentista = auth()->user()->dentista;
    $search = $request->get('q');
    
    $pacientes = Paciente::with('user')
        ->whereHas('citas', function ($query) use ($dentista) {
            $query->where('id_dentista', $dentista->id);
        })
        ->where(function ($query) use ($search) {
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('nombre', 'LIKE', "%{$search}%")
                  ->orWhere('apellido_paterno', 'LIKE', "%{$search}%")
                  ->orWhere('email', 'LIKE', "%{$search}%");
            });
        })
        ->take(10)
        ->get();
    
    return response()->json($pacientes);
}


public function historialPaciente($id)
{
    $dentista = auth()->user()->dentista;
    
    $paciente = Paciente::with('user')->findOrFail($id);
    
    $citas = Cita::with(['tratamientos'])
        ->where('id_paciente', $id)
        ->where('id_dentista', $dentista->id)
        ->orderBy('fecha', 'desc')
        ->orderBy('hora', 'desc')
        ->get();
    
    $totalCitas = $citas->count();
    $citasCompletadas = $citas->where('estado', 'confirmada')->count();
    $totalGastado = $citas->sum(function($cita) {
        return $cita->tratamientos->sum('costo');
    });
    
    return view('dentista.historial-paciente', compact('paciente', 'citas', 'totalCitas', 'citasCompletadas', 'totalGastado'));
}

}