<x-app-layout>
    <div class="space-y-6">
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <h1 class="text-3xl font-bold text-slate-800">
                Mis Citas
            </h1>
            <p class="text-gray-500 mt-2">
                Consulta todas las citas asignadas a tu agenda.
            </p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Total de citas</p>
                        <p class="text-3xl font-bold text-slate-800 mt-2">
                            {{ $citas->count() }}
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-cyan-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-calendar-check text-cyan-600 text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Pendientes</p>
                        <p class="text-3xl font-bold text-yellow-600 mt-2">
                            {{ $citas->where('estado', 'pendiente')->count() }}
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-clock text-yellow-600 text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Confirmadas</p>
                        <p class="text-3xl font-bold text-green-600 mt-2">
                            {{ $citas->where('estado', 'confirmada')->count() }}
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <h2 class="text-xl font-semibold text-slate-800">
                    Agenda Completa
                </h2>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">
                                Paciente
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">
                                Fecha
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">
                                Hora
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">
                                Motivo
                            </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">
                                Estado
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($citas as $cita)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-cyan-100 flex items-center justify-center">
                                            <i class="fas fa-user text-cyan-600"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium text-slate-800">
                                                {{ $cita->paciente->user->nombre }}
                                                {{ $cita->paciente->user->apellido_paterno }}
                                                {{ $cita->paciente->user->apellido_materno }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-700">

                                    {{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}

                                </td>
                                <td class="px-6 py-4 text-slate-700">
                                    {{ \Carbon\Carbon::parse($cita->hora)->format('h:i A') }}
                                </td>
                                <td class="px-6 py-4 text-slate-700">
                                    {{ $cita->motivo ?? 'Consulta general' }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($cita->estado == 'pendiente')
                                        <span class="px-3 py-1 bg-yellow-100 text-yellow-700 rounded-full text-xs font-medium">
                                            Pendiente
                                        </span>
                                    @elseif($cita->estado == 'confirmada')
                                        <span class="px-3 py-1 bg-green-100 text-green-700 rounded-full text-xs font-medium">
                                            Confirmada
                                        </span>
                                    @elseif($cita->estado == 'cancelada')
                                        <span class="px-3 py-1 bg-red-100 text-red-700 rounded-full text-xs font-medium">
                                            Cancelada
                                        </span>
                                    @else
                                        <span class="px-3 py-1 bg-gray-100 text-gray-700 rounded-full text-xs font-medium">
                                            {{ ucfirst($cita->estado) }}
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                    <i class="fas fa-calendar-times text-4xl mb-4 block text-gray-300"></i>
                                    No tienes citas registradas.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>