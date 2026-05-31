{{-- resources/views/dashboard/dentista.blade.php --}}
<div class="space-y-6">
    {{-- Tarjetas de estadísticas --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        {{-- Citas Hoy --}}
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Citas Hoy</p>
                    <p class="text-3xl font-bold text-slate-800 mt-1">
                        {{ $citasHoy }}
                    </p>
                    <p class="text-blue-600 text-xs mt-2">
                        <i class="fas fa-clock"></i>
                        {{ $citasPendientes }} pendientes
                    </p>
                </div>
                <div class="w-12 h-12 bg-cyan-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-calendar-day text-cyan-600 text-xl"></i>
                </div>
            </div>
        </div>

        {{-- Pacientes Atendidos --}}
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Pacientes Atendidos</p>
                    <p class="text-3xl font-bold text-slate-800 mt-1">
                        {{ $pacientesAtendidos }}
                    </p>
                    <p class="text-green-600 text-xs mt-2">
                        <i class="fas fa-user-check"></i>
                        Pacientes registrados
                    </p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-heartbeat text-green-600 text-xl"></i>
                </div>
            </div>
        </div>

        {{-- Tratamientos --}}
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Tratamientos Realizados</p>
                    <p class="text-3xl font-bold text-slate-800 mt-1">
                        {{ $tratamientosRealizados }}
                    </p>
                    <p class="text-purple-600 text-xs mt-2">
                        <i class="fas fa-chart-line"></i>
                        Tratamientos completados
                    </p>
                </div>
                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-stethoscope text-purple-600 text-xl"></i>
                </div>
            </div>
        </div>

        {{-- Próxima cita --}}
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-500 text-sm">Próxima Cita</p>
                    @if($proximaCita)
                        <p class="text-xl font-bold text-slate-800 mt-1">
                            {{ \Carbon\Carbon::parse($proximaCita->hora)->format('h:i A') }}
                        </p>
                        <p class="text-gray-500 text-xs mt-2">
                            <i class="fas fa-user"></i>
                            {{ $proximaCita->paciente->nombre }}
                        </p>
                    @else
                        <p class="text-gray-500 mt-2">
                            Sin citas próximas
                        </p>
                    @endif
                </div>
                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-bell text-orange-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>
    {{-- Agenda del día + últimos pacientes --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        {{-- Agenda --}}
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <h3 class="font-semibold text-slate-800 mb-4">
                <i class="fas fa-calendar-alt text-cyan-600 mr-2"></i>
                Agenda del Día
            </h3>
            <div class="space-y-3">
                @forelse($agendaHoy as $cita)
                    <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                        <div class="flex items-center gap-3">
                            {{-- Hora --}}
                            <div class="w-16 text-center">
                                <p class="font-bold text-slate-800">
                                    {{ \Carbon\Carbon::parse($cita->hora)->format('h:i A') }}
                                </p>
                            </div>
                            <div class="w-px h-8 bg-gray-300"></div>
                            {{-- Datos --}}
                            <div>
                                <p class="font-medium text-slate-800">
                                    {{ $cita->paciente->nombre }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    {{ $cita->motivo ?? 'Consulta general' }}
                                </p>
                            </div>
                        </div>
                        {{-- Botón --}}
                        <button class="text-cyan-600 hover:text-cyan-700 text-sm">
                            <i class="fas fa-check-circle"></i>
                            Atender
                        </button>
                    </div>
                @empty
                    <div class="text-center py-6 text-gray-500">
                        No hay citas para hoy
                    </div>
                @endforelse
            </div>
        </div>
        {{-- Últimos pacientes --}}
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <h3 class="font-semibold text-slate-800 mb-4">
                <i class="fas fa-user-friends text-cyan-600 mr-2"></i>
                Últimos Pacientes
            </h3>
            <div class="space-y-3">
                @forelse($ultimosPacientes as $paciente)
                    <div class="flex items-center gap-3 p-2 hover:bg-gray-50 rounded-lg transition">
                        {{-- Avatar --}}
                        <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center">
                            <i class="fas fa-user text-gray-500"></i>
                        </div>
                        {{-- Datos --}}
                        <div class="flex-1">
                            <p class="font-medium text-slate-800">
                                {{ $paciente->nombre }}
                            </p>
                            <p class="text-xs text-gray-500">
                                Registro:
                                {{ $paciente->created_at->format('d/m/Y') }}
                            </p>
                        </div>
                        {{-- Botón --}}
                        <button class="text-cyan-600 hover:text-cyan-700">
                            <i class="fas fa-file-medical"></i>
                        </button>
                    </div>
                @empty

                    <div class="text-center py-6 text-gray-500">
                        No hay pacientes registrados
                    </div>
                @endforelse
            </div>
        </div>
    </div>
    {{-- Próximos tratamientos --}}
    <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
        <h3 class="font-semibold text-slate-800 mb-4">
            <i class="fas fa-list-check text-cyan-600 mr-2"></i>
            Próximos Tratamientos Programados
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            @forelse($proximosTratamientos as $tratamiento)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div>
                        <p class="font-medium text-slate-800">
                            {{ $tratamiento->nombre }}
                        </p>
                        <p class="text-xs text-gray-500">
                           {{ $tratamiento->pacientes_pendientes }} pacientes pendientes
                        </p>
                    </div>
                    <span class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs">
                        Programado
                    </span>
                </div>
            @empty
            <div class="col-span-2 text-center py-6 text-gray-500">
                No hay tratamientos programados
            </div>
            @endforelse
        </div>
    </div>
</div>