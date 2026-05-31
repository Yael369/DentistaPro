<x-app-layout>
    <div class="max-w-7xl mx-auto space-y-6">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">
                Mis Citas
            </h1>
            <p class="text-gray-500 mt-2">
                Consulta todas tus citas y su estado
            </p>
        </div>
        <div class="bg-gradient-to-r from-cyan-500 to-blue-600 rounded-2xl p-6 text-white shadow-lg">
            <h2 class="text-xl font-semibold mb-4">
                Próxima cita
            </h2>
            @if($proximaCita)
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <p class="text-sm opacity-80">
                            Fecha
                        </p>
                        <p class="text-lg font-bold">
                            {{ \Carbon\Carbon::parse($proximaCita->fecha)->format('d/m/Y') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm opacity-80">
                            Hora
                        </p>
                        <p class="text-lg font-bold">
                            {{ \Carbon\Carbon::parse($proximaCita->hora)->format('h:i A') }}
                        </p>
                    </div>
                    <div>
                        <p class="text-sm opacity-80">
                            Dentista
                        </p>
                        <p class="text-lg font-bold">
                            Dr. {{ $proximaCita->dentista->user->nombre }}
                        </p>
                    </div>
                </div>
            @else
                <p class="text-white/90">
                    No tienes citas pendientes
                </p>
            @endif

        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-6 border-b border-gray-100">
                <h2 class="text-xl font-semibold text-slate-800">
                    Historial de citas
                </h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                                Fecha
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                                Hora
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                                Dentista
                            </th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-slate-700">
                                Estado
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($citas as $cita)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($cita->hora)->format('h:i A') }}
                                </td>
                                <td class="px-6 py-4">
                                    Dr. {{ $cita->dentista->user->nombre }}
                                </td>
                                <td class="px-6 py-4">
                                    @if($cita->estado == 'pendiente')
                                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold">
                                            Pendiente
                                        </span>
                                    @elseif($cita->estado == 'confirmada')
                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                            Confirmada
                                        </span>
                                    @elseif($cita->estado == 'cancelada')
                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold">
                                            Cancelada
                                        </span>
                                    @else
                                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-xs font-semibold">
                                            {{ $cita->estado }}
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-gray-500">No tienes citas registradas</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>