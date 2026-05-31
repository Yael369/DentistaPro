<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dentista;
use App\Models\Paciente;
use App\Models\Cita;
use App\Models\Tratamiento;
use App\Models\Especialidad;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
  
    public function dashboard()
{
    $totalDentistas = Dentista::count();
    $totalPacientes = Paciente::count();
    $totalCitas = Cita::count();
    $totalTratamientos = Tratamiento::count();
    
    $citasHoy = Cita::whereDate('fecha', Carbon::today())->count();
    $citasPendientes = Cita::where('estado', 'pendiente')->count();
    $citasConfirmadas = Cita::where('estado', 'confirmada')->count();
    $nuevosPacientesMes = Paciente::whereMonth('created_at', Carbon::now()->month)->count();
    
    $citasPendientesHoy = Cita::whereDate('fecha', Carbon::today())
        ->where('estado', 'pendiente')
        ->count();
    
    $ingresosMes = \App\Models\Pago::whereYear('fecha_pago', Carbon::now()->year)
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
    
    $pacientesRecientes = Paciente::with('user')
        ->latest()
        ->take(5)
        ->get();
    
    $diasSemana = [];
    $citasPorDia = [];
    
    for ($i = 6; $i >= 0; $i--) {
        $fecha = Carbon::today()->subDays($i);
        $diasSemana[] = $fecha->locale('es')->isoFormat('dddd');
        $citasPorDia[] = Cita::whereDate('fecha', $fecha)->count();
    }
    
    $ultimosPacientes = Paciente::with('user')->latest()->take(5)->get();
    $ultimasCitas = Cita::with(['paciente.user', 'dentista.user'])->latest()->take(5)->get();
    

    $ingresosMesAnterior = \App\Models\Pago::whereYear('fecha_pago', Carbon::now()->year)
        ->whereMonth('fecha_pago', Carbon::now()->subMonth()->month)
        ->sum('monto');
    
    $porcentajeIngresos = 0;
    if ($ingresosMesAnterior > 0) {
        $porcentajeIngresos = round((($ingresosMes - $ingresosMesAnterior) / $ingresosMesAnterior) * 100, 1);
    }
    
    return view('dashboard', compact(
        'totalDentistas', 
        'totalPacientes', 
        'totalCitas', 
        'totalTratamientos', 
        'citasHoy', 
        'citasPendientes', 
        'citasConfirmadas',
        'nuevosPacientesMes',
        'citasPendientesHoy',
        'ingresosMes',
        'especialidadesCount',
        'proximasCitas',
        'pacientesRecientes',
        'diasSemana',
        'citasPorDia',
        'ultimosPacientes',
        'ultimasCitas',
        'porcentajeIngresos'
    ));
}
    
    public function dentistas()
    {
        $dentistas = Dentista::with('user')->latest()->paginate(10);
        return view('admin.dentistas', compact('dentistas'));
    }
    
    public function crearDentista()
    {
        return view('admin.crear-dentista');
    }
    
    public function guardarDentista(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email',
            'telefono' => 'required|string|max:11',
            'password' => 'required|min:6',
        ]);
        
        $user = User::create([
            'nombre' => $request->nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'rol' => 'dentista',
        ]);
        
        Dentista::create([
            'user_id' => $user->id,
            'telefono' => $request->telefono,
        ]);
        
        return redirect()->route('admin.dentistas')->with('success', 'Dentista creado exitosamente');
    }
    
    public function editarDentista($id)
    {
        $dentista = Dentista::with('user')->findOrFail($id);
        return view('admin.editar-dentista', compact('dentista'));
    }
    
    public function actualizarDentista(Request $request, $id)
    {
        $dentista = Dentista::findOrFail($id);
        $user = $dentista->user;
        
        $request->validate([
            'nombre' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'telefono' => 'required|string|max:11',
        ]);
        
        $user->update([
            'nombre' => $request->nombre,
            'apellido_paterno' => $request->apellido_paterno,
            'apellido_materno' => $request->apellido_materno,
            'email' => $request->email,
        ]);
        
        $dentista->update([
            'telefono' => $request->telefono,
        ]);
        
        return redirect()->route('admin.dentistas')->with('success', 'Dentista actualizado exitosamente');
    }
    
    public function eliminarDentista($id)
    {
        $dentista = Dentista::findOrFail($id);
        $user = $dentista->user;
        
        $dentista->delete();
        $user->delete();
        
        return redirect()->route('admin.dentistas')->with('success', 'Dentista eliminado exitosamente');
    }
    
 
    public function pacientes()
    {
        $pacientes = Paciente::with('user')->latest()->paginate(10);
        return view('admin.pacientes', compact('pacientes'));
    }
    
    public function verPaciente($id)
    {
        $paciente = Paciente::with('user', 'citas.dentista.user')->findOrFail($id);
        return view('admin.ver-paciente', compact('paciente'));
    }
    
    public function citas()
    {
        $citas = Cita::with(['paciente.user', 'dentista.user'])
            ->latest()
            ->paginate(15);
        
        return view('admin.citas', compact('citas'));
    }
    
    public function tratamientos()
    {
        $tratamientos = Tratamiento::latest()->paginate(10);
        return view('admin.tratamientos', compact('tratamientos'));
    }
    
    public function crearTratamiento()
    {
        return view('admin.crear-tratamiento');
    }
    
    public function guardarTratamiento(Request $request)
    {
        $request->validate([
            'nombre_tratamiento' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'costo' => 'required|numeric|min:0',
        ]);
        
        Tratamiento::create($request->all());
        
        return redirect()->route('admin.tratamientos')->with('success', 'Tratamiento creado exitosamente');
    }
    
    public function editarTratamiento($id)
    {
        $tratamiento = Tratamiento::findOrFail($id);
        return view('admin.editar-tratamiento', compact('tratamiento'));
    }
    
    public function actualizarTratamiento(Request $request, $id)
    {
        $tratamiento = Tratamiento::findOrFail($id);
        
        $request->validate([
            'nombre_tratamiento' => 'required|string|max:100',
            'descripcion' => 'nullable|string',
            'costo' => 'required|numeric|min:0',
        ]);
        
        $tratamiento->update($request->all());
        
        return redirect()->route('admin.tratamientos')->with('success', 'Tratamiento actualizado exitosamente');
    }
    
    public function eliminarTratamiento($id)
    {
        $tratamiento = Tratamiento::findOrFail($id);
        $tratamiento->delete();
        
        return redirect()->route('admin.tratamientos')->with('success', 'Tratamiento eliminado exitosamente');
    }

    public function usuarios()
    {
    $usuarios = User::with(['paciente', 'dentista'])
        ->latest()
        ->paginate(15);
    
    return view('admin.usuarios', compact('usuarios'));
    }


    public function reportes()
    {
    $citasPorMes = Cita::selectRaw('MONTH(fecha) as mes, COUNT(*) as total')
        ->whereYear('fecha', Carbon::now()->year)
        ->groupBy('mes')
        ->orderBy('mes')
        ->get();
    
    $citasPorEstado = Cita::selectRaw('estado, COUNT(*) as total')
        ->groupBy('estado')
        ->get();
    
    $ingresosPorMes = \App\Models\Pago::selectRaw('MONTH(fecha_pago) as mes, SUM(monto) as total')
        ->whereYear('fecha_pago', Carbon::now()->year)
        ->groupBy('mes')
        ->orderBy('mes')
        ->get();
    
    $topTratamientos = Tratamiento::withCount('citas')
        ->orderBy('citas_count', 'desc')
        ->take(5)
        ->get();
    
    return view('admin.reportes', compact('citasPorMes', 'citasPorEstado', 'ingresosPorMes', 'topTratamientos'));
    }


    public function configuracion()
    {
    $especialidades = Especialidad::all();
    return view('admin.configuracion', compact('especialidades'));
    }

    public function guardarEspecialidad(Request $request)
    {
    $request->validate([
        'nombre_especialidad' => 'required|string|max:100',
        'descripcion' => 'nullable|string',
    ]);
    
    Especialidad::create($request->all());
    
    return back()->with('success', 'Especialidad creada exitosamente');
    }

    public function eliminarEspecialidad($id)
    {
        $especialidad = Especialidad::findOrFail($id);
        $especialidad->delete();
    
        return back()->with('success', 'Especialidad eliminada exitosamente');
    }
}