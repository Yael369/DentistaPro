<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PacientesController;
use App\Http\Controllers\DentistasController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth', 'paciente')->group(function () {

    Route::get('/paciente/register',
        [PacientesController::class, 'registro_informacion'])
        ->name('paciente.register');

    Route::post('/paciente/register',
        [PacientesController::class, 'guardarRegistro'])
        ->name('paciente.register.store');

    // Mostrar perfil
    Route::get('/mi-perfil',
        [PacientesController::class, 'perfil'])
        ->name('paciente.perfil');

    // Actualizar perfil
    Route::put('/mi-perfil',
        [PacientesController::class, 'actualizarPerfil'])
        ->name('paciente.perfil.update');

    Route::get('/mis-citas', [PacientesController::class, 'misCitas'])
    ->name('paciente.citas');

    Route::get('/citas/agendar', [PacientesController::class, 'agendarCitaForm'])->name('citas.agendar');
    Route::post('/citas/agendar', [PacientesController::class, 'guardarCita'])->name('citas.guardar');
    Route::get('/citas/{id}/reprogramar', [PacientesController::class, 'reprogramarForm'])->name('citas.reprogramar');
    Route::put('/citas/{id}', [PacientesController::class, 'actualizarCita'])->name('citas.actualizar');
    Route::delete('/citas/{id}', [PacientesController::class, 'cancelarCita'])->name('citas.cancelar');

    Route::get('/mis-pagos', [PacientesController::class, 'pagos'])
    ->name('paciente.pagos');

    Route::get('/profile',
        [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile',
        [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile',
        [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
        
});

Route::middleware(['auth', 'dentista'])->group(function () {
    Route::get('/dentista/dashboard', [DentistasController::class, 'dashboard'])->name('dentista.dashboard');
    Route::get('/dentista/citas', [DentistasController::class, 'misCitas'])->name('dentista.citas');
    Route::get('/dentista/pacientes', [DentistasController::class, 'pacientes'])->name('dentista.pacientes');
    Route::get('/dentista/consultas', [DentistasController::class, 'consultas'])->name('dentista.consultas');
    Route::get('/dentista/historial', [DentistasController::class, 'historialIndex'])->name('dentista.historial');
    Route::get('/dentista/historial/{id}', [DentistasController::class, 'historialPaciente'])->name('dentista.historial.paciente');
    Route::get('/dentista/buscar-pacientes', [DentistasController::class, 'buscarPacientes'])->name('dentista.buscar.pacientes');
    Route::get('/dentista/pacientes/crear', [DentistasController::class, 'crearPaciente'])->name('dentista.pacientes.crear');
    Route::post('/dentista/pacientes', [DentistasController::class, 'guardarPaciente'])->name('dentista.guardarPaciente');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('dashboard');
    })->name('admin.dashboard');
    Route::get('/admin/usuarios', [AdminController::class, 'usuarios'])->name('admin.usuarios');
    Route::get('/admin/dentistas', [AdminController::class, 'dentistas'])->name('admin.dentistas');
    Route::get('/admin/dentistas/crear', [AdminController::class, 'crearDentista'])->name('admin.dentistas.crear');
    Route::post('/admin/dentistas', [AdminController::class, 'guardarDentista'])->name('admin.guardarDentista');
    Route::get('/admin/dentistas/{id}/editar', [AdminController::class, 'editarDentista'])->name('admin.dentistas.editar');
    Route::put('/admin/dentistas/{id}', [AdminController::class, 'actualizarDentista'])->name('admin.dentistas.actualizar');
    Route::delete('/admin/dentistas/{id}', [AdminController::class, 'eliminarDentista'])->name('admin.dentistas.eliminar');
    Route::get('/admin/pacientes', [AdminController::class, 'pacientes'])->name('admin.pacientes');
    Route::get('/admin/pacientes/{id}', [AdminController::class, 'verPaciente'])->name('admin.pacientes.ver');
    Route::get('/admin/citas', [AdminController::class, 'citas'])->name('admin.citas');
    Route::get('/admin/reportes', [AdminController::class, 'reportes'])->name('admin.reportes');
    Route::get('/admin/configuracion', [AdminController::class, 'configuracion'])->name('admin.configuracion');
    Route::get('/admin/especialidades', [AdminController::class, 'especialidades'])->name('admin.especialidades');
    Route::post('/admin/especialidades', [AdminController::class, 'guardarEspecialidad'])->name('admin.especialidades.guardar');
});

require __DIR__.'/auth.php';

