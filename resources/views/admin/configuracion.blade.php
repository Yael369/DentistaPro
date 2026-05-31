<x-app-layout>
    <div class="space-y-6">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">Configuración</h1>
            <p class="text-gray-500 mt-2">Gestiona las especialidades y configuraciones del sistema</p>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold text-slate-800">
                    <i class="fas fa-tags text-cyan-600 mr-2"></i>Especialidades
                </h2>
                <button onclick="abrirModalEspecialidad()" class="bg-cyan-600 hover:bg-cyan-700 text-white px-3 py-1 rounded-lg text-sm">
                    <i class="fas fa-plus"></i> Nueva Especialidad
                </button>
            </div>

            <div class="space-y-2">
                @forelse($especialidades as $especialidad)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div>
                        <p class="font-medium text-slate-800">{{ $especialidad->nombre_especialidad }}</p>
                        <p class="text-xs text-gray-500">{{ $especialidad->descripcion ?? 'Sin descripción' }}</p>
                    </div>
                    <form action="{{ route('admin.especialidades.eliminar', $especialidad->id) }}" 
                          method="POST" 
                          onsubmit="return confirm('¿Eliminar esta especialidad?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-700">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
                @empty
                    <p class="text-center text-gray-500 py-4">No hay especialidades registradas</p>
                @endforelse
            </div>
        </div>
    </div>

    <div id="modalEspecialidad" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50">
        <div class="bg-white rounded-xl p-6 w-full max-w-md">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-slate-800">Nueva Especialidad</h3>
                <button onclick="cerrarModalEspecialidad()" class="text-gray-500 hover:text-gray-700">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form method="POST" action="{{ route('admin.especialidades.guardar') }}">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                        <input type="text" name="nombre_especialidad" class="w-full rounded-lg border-gray-300" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Descripción</label>
                        <textarea name="descripcion" rows="3" class="w-full rounded-lg border-gray-300"></textarea>
                    </div>
                </div>
                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" onclick="cerrarModalEspecialidad()" class="px-4 py-2 bg-gray-100 rounded-lg">Cancelar</button>
                    <button type="submit" class="px-4 py-2 bg-cyan-600 text-white rounded-lg">Guardar</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function abrirModalEspecialidad() {
            document.getElementById('modalEspecialidad').classList.remove('hidden');
            document.getElementById('modalEspecialidad').classList.add('flex');
        }
        
        function cerrarModalEspecialidad() {
            document.getElementById('modalEspecialidad').classList.add('hidden');
            document.getElementById('modalEspecialidad').classList.remove('flex');
        }
    </script>
</x-app-layout>