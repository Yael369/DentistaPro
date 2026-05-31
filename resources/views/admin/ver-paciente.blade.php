<x-app-layout>
    <div class="space-y-6">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.pacientes') }}" class="text-cyan-600 hover:text-cyan-700">
                <i class="fas fa-arrow-left mr-2"></i> Volver a pacientes
            </a>
        </div>
        <div class="bg-gradient-to-r from-green-500 to-teal-600 rounded-2xl p-6 text-white shadow-lg">
            <div class="flex items-center gap-4">
                <div class="w-20 h-20 rounded-full bg-white/20 flex items-center justify-center">
                    <i class="fas fa-user-circle text-4xl"></i>
                </div>
                <div>
                    <h1 class="text-2xl font-bold">
                        {{ $paciente->user->nombre }} {{ $paciente->user->apellido_paterno }} {{ $paciente->user->apellido_materno }}
                    </h1>
                    <p class="text-white/80 mt-1">
                        <i class="fas fa-envelope mr-2"></i>{{ $paciente->user->email }} | 
                        <i class="fas fa-phone mr-2"></i>{{ $paciente->telefono }}
                    </p>
                    <p class="text-white/80 mt-1">
                        <i class="fas fa-calendar mr-2"></i>Miembro desde: {{ $paciente->created_at->format('d/m/Y') }}
                    </p>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Total de citas</p>
                        <p class="text-3xl font-bold text-slate-800 mt-2">{{ $paciente->citas->count() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-calendar-check text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Citas completadas</p>
                        <p class="text-3xl font-bold text-green-600 mt-2">
                            {{ $paciente->citas->where('estado', 'confirmada')->count() }}
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Dirección</p>
                        <p class="text-lg font-bold text-slate-800 mt-2">
                            {{ $paciente->calle }} #{{ $paciente->numero_exterior }}
                        </p>
                        <p class="text-xs text-gray-500">{{ $paciente->fraccionamiento }}, CP {{ $paciente->codigo_postal }}</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-map-marker-alt text-purple-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <h2 class="text-xl font-semibold text-slate-800">Historial de Citas</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">Fecha</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">Hora</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">Dentista</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">Motivo</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">Estado</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($paciente->citas as $cita)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}</td>
                                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($cita->hora)->format('h:i A') }}</td>
                                <td class="px-6 py-4">
                                    Dr. {{ $cita->dentista->user->nombre ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4">{{ $cita->motivo ?? 'Consulta general' }}</td>
                                <td class="px-6 py-4">
                                    @if($cita->estado == 'pendiente')
                                        <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded-full text-xs">Pendiente</span>
                                    @elseif($cita->estado == 'confirmada')
                                        <span class="bg-green-100 text-green-700 px-2 py-1 rounded-full text-xs">Confirmada</span>
                                    @else
                                        <span class="bg-red-100 text-red-700 px-2 py-1 rounded-full text-xs">Cancelada</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                    No hay citas registradas
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>