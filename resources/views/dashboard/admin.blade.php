{{-- resources/views/dashboard/admin.blade.php --}}
<div class="space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-all group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Total Pacientes</p>
                    <p class="text-3xl font-bold text-slate-800 mt-1">{{ $totalPacientes }}</p>
                    <p class="text-green-600 text-xs mt-2">
                        <i class="fas fa-arrow-up"></i> +{{ $nuevosPacientesMes }} este mes
                    </p>
                </div>
                <div class="w-12 h-12 bg-cyan-100 rounded-lg flex items-center justify-center group-hover:bg-cyan-600 transition">
                    <i class="fas fa-users text-cyan-600 text-xl group-hover:text-white"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-all group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Citas Hoy</p>
                    <p class="text-3xl font-bold text-slate-800 mt-1">{{ $citasHoy }}</p>
                    <p class="text-orange-600 text-xs mt-2">
                        <i class="fas fa-clock"></i> {{ $citasPendientesHoy }} pendientes
                    </p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center group-hover:bg-blue-600 transition">
                    <i class="fas fa-calendar-check text-blue-600 text-xl group-hover:text-white"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-all group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Ingresos del Mes</p>
                    <p class="text-3xl font-bold text-slate-800 mt-1">${{ number_format($ingresosMes, 2) }}</p>
                    <p class="text-green-600 text-xs mt-2">
                        <i class="fas fa-arrow-up"></i> {{ $porcentajeIngresos }}% vs mes anterior
                    </p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center group-hover:bg-green-600 transition">
                    <i class="fas fa-dollar-sign text-green-600 text-xl group-hover:text-white"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 hover:shadow-md transition-all group">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Dentistas Activos</p>
                    <p class="text-3xl font-bold text-slate-800 mt-1">{{ $totalDentistas }}</p>
                    <p class="text-blue-600 text-xs mt-2">
                        <i class="fas fa-user-md"></i> {{ $especialidadesCount }} especialidades
                    </p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center group-hover:bg-purple-600 transition">
                    <i class="fas fa-tooth text-purple-600 text-xl group-hover:text-white"></i>
                </div>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Citas por día (Gráfico) --}}
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-slate-800">
                    <i class="fas fa-chart-line text-cyan-600 mr-2"></i>Citas de la Semana
                </h3>
            </div>
            <div class="h-64 flex items-center justify-center bg-gray-50 rounded-lg">
                <canvas id="citasChart" class="w-full h-full"></canvas>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex justify-between items-center mb-4">
                <h3 class="font-semibold text-slate-800">
                    <i class="fas fa-calendar-week text-cyan-600 mr-2"></i>Próximas Citas
                </h3>
                <a href="{{ route('admin.citas') }}" class="text-cyan-600 text-sm hover:underline">Ver todas</a>
            </div>
            <div class="space-y-3">
                @forelse($proximasCitas as $cita)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-cyan-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-cyan-600"></i>
                        </div>
                        <div>
                            <p class="font-medium text-slate-800">
                                {{ $cita->paciente->user->nombre ?? 'N/A' }} {{ $cita->paciente->user->apellido_paterno ?? '' }}
                            </p>
                            <p class="text-xs text-gray-500">
                                <i class="fas fa-tooth mr-1"></i> Dr(a). {{ $cita->dentista->user->nombre ?? 'N/A' }}
                            </p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-sm font-semibold text-slate-800">{{ \Carbon\Carbon::parse($cita->hora)->format('h:i A') }}</p>
                        <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}</p>
                    </div>
                </div>
                @empty
                    <p class="text-center text-gray-500 py-4">No hay próximas citas</p>
                @endforelse
            </div>
        </div>
    </div>
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <div class="flex justify-between items-center mb-4">
            <h3 class="font-semibold text-slate-800">
                <i class="fas fa-user-plus text-cyan-600 mr-2"></i>Pacientes Recientes
            </h3>
            <a href="{{ route('admin.pacientes') }}" class="text-cyan-600 text-sm hover:underline">Ver todos</a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="text-left p-3 text-xs font-semibold text-gray-500">Paciente</th>
                        <th class="text-left p-3 text-xs font-semibold text-gray-500">Email</th>
                        <th class="text-left p-3 text-xs font-semibold text-gray-500">Teléfono</th>
                        <th class="text-left p-3 text-xs font-semibold text-gray-500">Registro</th>
                        <th class="text-left p-3 text-xs font-semibold text-gray-500">Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pacientesRecientes as $paciente)
                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                        <td class="p-3">
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-full flex items-center justify-center text-white text-xs font-bold">
                                    {{ substr($paciente->user->nombre ?? 'P', 0, 1) }}
                                </div>
                                <span class="text-sm">{{ $paciente->user->nombre ?? 'N/A' }} {{ $paciente->user->apellido_paterno ?? '' }}</span>
                            </div>
                        </td>
                        <td class="p-3 text-sm text-gray-600">{{ $paciente->user->email ?? 'N/A' }}</td>
                        <td class="p-3 text-sm text-gray-600">{{ $paciente->telefono }}</td>
                        <td class="p-3 text-sm text-gray-600">{{ $paciente->created_at->format('d/m/Y') }}</td>
                        <td class="p-3">
                            <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-xs">
                                <i class="fas fa-check-circle mr-1"></i>Activo
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="p-3 text-center text-gray-500">No hay pacientes registrados</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('citasChart').getContext('2d');
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: @json($diasSemana),
            datasets: [{
                label: 'Citas',
                data: @json($citasPorDia),
                borderColor: '#0ea5e9',
                backgroundColor: 'rgba(14, 165, 233, 0.1)',
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
</script>