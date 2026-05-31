<x-app-layout>
    <div class="space-y-6">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold text-slate-800">Tratamientos</h1>
                <p class="text-gray-500 mt-2">Gestiona los tratamientos y procedimientos dentales</p>
            </div>
            <a href="{{ route('admin.tratamientos.crear') }}" class="bg-cyan-600 hover:bg-cyan-700 text-white px-4 py-2 rounded-lg flex items-center gap-2">
                <i class="fas fa-plus"></i> Nuevo Tratamiento
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
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">Tratamiento</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">Descripción</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">Costo</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">Citas</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($tratamientos as $tratamiento)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4 font-medium text-slate-800">
                                    {{ $tratamiento->nombre_tratamiento }}
                                </td>
                                <td class="px-6 py-4 text-slate-700">
                                    {{ Str::limit($tratamiento->descripcion, 50) ?: 'Sin descripción' }}
                                </td>
                                <td class="px-6 py-4 text-slate-700 font-semibold">
                                    ${{ number_format($tratamiento->costo, 2) }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="bg-blue-100 text-blue-700 px-2 py-1 rounded-full text-xs">
                                        {{ $tratamiento->citas->count() }} citas
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-2">
                                        <a href="{{ route('admin.tratamientos.editar', $tratamiento->id) }}" 
                                           class="text-cyan-600 hover:text-cyan-700">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.tratamientos.eliminar', $tratamiento->id) }}" 
                                              method="POST" 
                                              onsubmit="return confirm('¿Eliminar este tratamiento?')">
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
                                    No hay tratamientos registrados
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