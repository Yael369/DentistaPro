<x-app-layout>
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-slate-800">Editar Dentista</h1>
                <p class="text-gray-500 mt-1">Actualiza la información del dentista</p>
            </div>

            <form method="POST" action="{{ route('admin.dentistas.actualizar', $dentista->id) }}">
                @csrf
                @method('PUT')

                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                            <input type="text" name="nombre" value="{{ old('nombre', $dentista->user->nombre) }}" 
                                   class="w-full rounded-lg border-gray-300 focus:ring-cyan-500 focus:border-cyan-500" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Apellido Paterno</label>
                            <input type="text" name="apellido_paterno" value="{{ old('apellido_paterno', $dentista->user->apellido_paterno) }}" 
                                   class="w-full rounded-lg border-gray-300 focus:ring-cyan-500 focus:border-cyan-500" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Apellido Materno</label>
                        <input type="text" name="apellido_materno" value="{{ old('apellido_materno', $dentista->user->apellido_materno) }}" 
                               class="w-full rounded-lg border-gray-300 focus:ring-cyan-500 focus:border-cyan-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email', $dentista->user->email) }}" 
                               class="w-full rounded-lg border-gray-300 focus:ring-cyan-500 focus:border-cyan-500" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Teléfono</label>
                        <input type="text" name="telefono" value="{{ old('telefono', $dentista->telefono) }}" 
                               class="w-full rounded-lg border-gray-300 focus:ring-cyan-500 focus:border-cyan-500" required>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <a href="{{ route('admin.dentistas') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">
                        Cancelar
                    </a>
                    <button type="submit" class="px-4 py-2 bg-cyan-600 text-white rounded-lg hover:bg-cyan-700">
                        <i class="fas fa-save mr-2"></i>Actualizar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>