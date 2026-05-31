<x-app-layout>
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="mb-6">
                <h1 class="text-2xl font-bold text-slate-800">Nuevo Tratamiento</h1>
                <p class="text-gray-500 mt-1">Registra un nuevo tratamiento o procedimiento dental</p>
            </div>

            <form method="POST" action="{{ route('admin.tratamientos.guardar') }}">
                @csrf

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nombre del tratamiento</label>
                        <input type="text" name="nombre_tratamiento" value="{{ old('nombre_tratamiento') }}" 
                               class="w-full rounded-lg border-gray-300 focus:ring-cyan-500 focus:border-cyan-500" 
                               placeholder="Ej: Limpieza dental, Ortodoncia, etc." required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                        <textarea name="descripcion" rows="4" 
                               class="w-full rounded-lg border-gray-300 focus:ring-cyan-500 focus:border-cyan-500"
                               placeholder="Describe el procedimiento, beneficios, etc.">{{ old('descripcion') }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Costo ($)</label>
                        <input type="number" step="0.01" name="costo" value="{{ old('costo') }}" 
                               class="w-full rounded-lg border-gray-300 focus:ring-cyan-500 focus:border-cyan-500" 
                               placeholder="0.00" required>
                    </div>
                </div>

                <div class="mt-6 flex justify-end gap-3">
                    <a href="{{ route('admin.tratamientos') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">
                        Cancelar
                    </a>
                    <button type="submit" class="px-4 py-2 bg-cyan-600 text-white rounded-lg hover:bg-cyan-700">
                        <i class="fas fa-save mr-2"></i>Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>