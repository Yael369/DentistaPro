<x-app-layout>
    <div class="space-y-6">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">Mis Pacientes</h1>
            <p class="text-gray-500 mt-2">Pacientes que han tenido citas contigo</p>
        </div>

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">Paciente</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">Email</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">Teléfono</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">Total Citas</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($pacientes as $paciente)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-cyan-100 flex items-center justify-center">
                                            <i class="fas fa-user text-cyan-600"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium text-slate-800">
                                                {{ $paciente->user->nombre }} {{ $paciente->user->apellido_paterno }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-700">{{ $paciente->user->email }}</td>
                                <td class="px-6 py-4 text-slate-700">{{ $paciente->telefono }}</td>
                                <td class="px-6 py-4">
                                    <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded-full text-xs">
                                        {{ $paciente->citas->count() }} citas
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('dentista.historial.paciente', $paciente->id) }}" class="text-cyan-600 hover:text-cyan-700">
                                        <i class="fas fa-history"></i> Ver historial
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                    <i class="fas fa-users text-4xl mb-4 block text-gray-300"></i>
                                    No tienes pacientes registrados aún
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t border-gray-100">
                {{ $pacientes->links() }}
            </div>
        </div>
    </div>
</x-app-layout>