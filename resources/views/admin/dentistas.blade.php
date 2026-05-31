<x-app-layout>
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-slate-800">Dentistas</h1>
                <p class="text-gray-500 mt-2">Gestiona los dentistas de la clínica</p>
            </div>
            <a href="{{ route('admin.dentistas.crear') }}" class="bg-cyan-600 hover:bg-cyan-700 text-white px-4 py-2 rounded-lg flex items-center gap-2">
                <i class="fas fa-plus"></i> Nuevo Dentista
            </a>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">Dentista</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">Email</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">Teléfono</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">Registro</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($dentistas as $dentista)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-cyan-100 flex items-center justify-center">
                                            <i class="fas fa-user-md text-cyan-600"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium text-slate-800">
                                                {{ $dentista->user->nombre }} {{ $dentista->user->apellido_paterno }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-700">{{ $dentista->user->email }}</td>
                                <td class="px-6 py-4 text-slate-700">{{ $dentista->telefono }}</td>
                                <td class="px-6 py-4 text-slate-700">{{optional($dentista->created_at)->format('d/m/Y') }}</td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-2">
                                        <a href="{{ route('admin.dentistas.editar', $dentista->id) }}" 
                                           class="text-cyan-600 hover:text-cyan-700">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.dentistas.eliminar', $dentista->id) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('¿Eliminar este dentista?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-700">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                    No hay dentistas registrados
                                </tr>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t border-gray-100">
                {{ $dentistas->links() }}
            </div>
        </div>
    </div>
</x-app-layout>