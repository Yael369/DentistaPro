<x-app-layout>
    <div class="space-y-6">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">Todas las Citas</h1>
            <p class="text-gray-500 mt-2">Visualiza todas las citas del sistema</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">Paciente</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">Dentista</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">Fecha</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">Hora</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">Motivo</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">Estado</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($citas as $cita)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4">
                                    {{ $cita->paciente->user->nombre ?? 'N/A' }} {{ $cita->paciente->user->apellido_paterno ?? '' }}
                                </td>
                                <td class="px-6 py-4">
                                    Dr. {{ $cita->dentista->user->nombre ?? 'N/A' }}
                                </td>
                                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}</td>
                                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($cita->hora)->format('h:i A') }}</td>
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
                                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                    No hay citas registradas
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t border-gray-100">
                {{ $citas->links() }}
            </div>
        </div>
    </div>
</x-app-layout>