<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;
use App\Models\Cita;
use App\Models\Pago;
use App\Models\Dentista; 


class PacientesController extends Controller
{
    
    public function registro_informacion()
    {
        return view('paciente.registro');
    }

    public function perfil()
    {
    $user = auth()->user();
    $paciente = $user->paciente;
    return view('paciente.perfil', compact('paciente'));
    }

 public function pagos()
{
    $paciente = auth()->user()->paciente;

   
    $pagos = Pago::with('cita')
        ->whereHas('cita', function ($query) use ($paciente) {
            $query->where('id_paciente', $paciente->id);
        })
        ->latest()
        ->get();

   
    $citasPendientesPago = Cita::where('id_paciente', $paciente->id)
        ->whereDoesntHave('pago')
        ->count();

    
    $totalPagado = $pagos->sum('monto');

   
    return view('paciente.pagos', compact('pagos', 'citasPendientesPago', 'totalPagado'));
}


    public function actualizarPerfil(Request $request)
{
    $request->validate([
        'nombre' => 'required',
        'apellido_paterno' => 'required',
        'telefono' => 'required',
    ]);

    $user = auth()->user();
    $paciente = $user->paciente;

    $user->update([
        'nombre' => $request->nombre,
        'apellido_paterno' => $request->apellido_paterno,
        'apellido_materno' => $request->apellido_materno,
    ]);

    $paciente->update([
        'telefono' => $request->telefono,
        'calle' => $request->calle,
        'numero_exterior' => $request->numero_exterior,
        'fraccionamiento' => $request->fraccionamiento,
        'codigo_postal' => $request->codigo_postal,
        'genero' => $request->genero,
        'fecha_nacimiento' => $request->fecha_nacimiento,
    ]);

    return back()->with('success', 'Perfil actualizado correctamente');
}


    public function misCitas()
{
    $paciente = auth()->user()->paciente;


    $citas = Cita::with('dentista.user')
        ->where('id_paciente', $paciente->id)
        ->orderBy('fecha', 'desc')
        ->orderBy('hora', 'desc')
        ->get();


    $proximaCita = Cita::with('dentista.user')
        ->where('id_paciente', $paciente->id)
        ->whereDate('fecha', '>=', now())
        ->where('estado', 'pendiente')
        ->orderBy('fecha')
        ->orderBy('hora')
        ->first();

    return view('paciente.citas', compact(
        'citas',
        'proximaCita'
    ));
}

   
    public function guardarRegistro(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'telefono' => 'required|string|max:11',
            'calle' => 'required|string|max:255',
            'numero_exterior' => 'required|string|max:10',
            'fraccionamiento' => 'required|string|max:255',
            'codigo_postal' => 'required|string|max:10',
            'genero' => 'required|in:masculino,femenino,Sin especificar',
            'fecha_nacimiento' => 'required|date',
        ]);

        
        Paciente::create([
            'user_id' => $user->id,
            'telefono' => $request->telefono,
            'calle' => $request->calle,
            'numero_exterior' => $request->numero_exterior,
            'fraccionamiento' => $request->fraccionamiento,
            'codigo_postal' => $request->codigo_postal,
            'genero' => $request->genero,
            'fecha_nacimiento' => $request->fecha_nacimiento,
        ]);

        return redirect()->route('dashboard')->with('success', '¡Registro completado! Bienvenido a tu panel.');
    }

    public function agendarCitaForm()
    {
    $dentistas = Dentista::with('user')->get();
    return view('paciente.agendar-cita', compact('dentistas'));
    }


    public function guardarCita(Request $request)
    {
    $request->validate([
        'id_dentista' => 'required|exists:dentistas,id',
        'fecha' => 'required|date|after_or_equal:today',
        'hora' => 'required|date_format:H:i',
        'motivo' => 'nullable|string|max:500',
    ]);

    $paciente = auth()->user()->paciente;
    $existe = Cita::where('id_dentista', $request->id_dentista)
        ->where('fecha', $request->fecha)
        ->where('hora', $request->hora)
        ->exists();

    if ($existe) {
        return back()->withErrors(['hora' => 'La fecha y hora ya están ocupadas.']);
    }

    Cita::create([
        'id_paciente' => $paciente->id,
        'id_dentista' => $request->id_dentista,
        'fecha' => $request->fecha,
        'hora' => $request->hora,
        'motivo' => $request->motivo,
        'estado' => 'pendiente',
    ]);

    return redirect()->route('paciente.citas')->with('success', 'Cita agendada correctamente.');
}


    public function reprogramarForm($id)
    {
    $paciente = auth()->user()->paciente;
    $cita = Cita::where('id', $id)
        ->where('id_paciente', $paciente->id)
        ->where('estado', 'pendiente')
        ->firstOrFail();

    $dentistas = Dentista::with('user')->get();
    return view('paciente.reprogramar-cita', compact('cita', 'dentistas'));
    }

    public function actualizarCita(Request $request, $id)
    {
    $paciente = auth()->user()->paciente;
    $cita = Cita::where('id', $id)
        ->where('id_paciente', $paciente->id)
        ->where('estado', 'pendiente')
        ->firstOrFail();

    $request->validate([
        'id_dentista' => 'required|exists:dentistas,id',
        'fecha' => 'required|date|after_or_equal:today',
        'hora' => 'required|date_format:H:i',
        'motivo' => 'nullable|string|max:500',
    ]);

    $existe = Cita::where('id_dentista', $request->id_dentista)
        ->where('fecha', $request->fecha)
        ->where('hora', $request->hora)
        ->where('id', '!=', $cita->id)
        ->exists();

    if ($existe) {
        return back()->withErrors(['hora' => 'La fecha y hora ya están ocupadas.']);
    }

    $cita->update([
        'id_dentista' => $request->id_dentista,
        'fecha' => $request->fecha,
        'hora' => $request->hora,
        'motivo' => $request->motivo,
    ]);

    return redirect()->route('paciente.citas')->with('success', 'Cita reprogramada correctamente.');
}


    public function cancelarCita($id)
    {
    $paciente = auth()->user()->paciente;
    $cita = Cita::where('id', $id)
        ->where('id_paciente', $paciente->id)
        ->where('estado', 'pendiente')
        ->firstOrFail();

    $cita->update(['estado' => 'cancelada']);

    return redirect()->route('paciente.citas')->with('success', 'Cita cancelada correctamente.');
    }

}