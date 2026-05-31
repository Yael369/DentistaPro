<x-app-layout>
    <div class="space-y-6">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">Consultas Realizadas</h1>
            <p class="text-gray-500 mt-2">Historial de tratamientos y procedimientos</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">Tratamiento</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">Descripción</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">Costo</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">Paciente</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">Fecha</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($tratamientos as $tratamiento)
                            @foreach($tratamiento->citas as $cita)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4 font-medium text-slate-800">
                                    {{ $tratamiento->nombre_tratamiento }}
                                </td>
                                <td class="px-6 py-4 text-slate-700">
                                    {{ Str::limit($tratamiento->descripcion, 50) }}
                                </td>
                                <td class="px-6 py-4 text-slate-700 font-semibold">
                                    ${{ number_format($tratamiento->costo, 2) }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <div class="w-8 h-8 rounded-full bg-gray-100 flex items-center justify-center">
                                            <i class="fas fa-user text-gray-500 text-sm"></i>
                                        </div>
                                        <span class="text-slate-700">
                                            {{ $cita->paciente->user->nombre }} {{ $cita->paciente->user->apellido_paterno }}
                                        </span>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-700">
                                    {{ \Carbon\Carbon::parse($cita->fecha)->format('d/m/Y') }}
                                </td>
                            </tr>
                            @endforeach
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                    <i class="fas fa-stethoscope text-4xl mb-4 block text-gray-300"></i>
                                    No hay consultas realizadas aún
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t border-gray-100">
                {{ $tratamientos->links() }}
            </div>
        </div>
    </div>
</x-app-layout>