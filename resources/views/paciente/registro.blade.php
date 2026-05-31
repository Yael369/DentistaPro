{{-- resources/views/paciente/registro.blade.php --}}
<x-app-layout>
    <div class="max-w-2xl mx-auto mt-10">
        <div class="bg-white rounded-xl shadow-lg p-8">
            <div class="text-center mb-6">
                <div class="text-5xl mb-3">🦷</div>
                <h2 class="text-2xl font-bold text-slate-800">Completa tu registro</h2>
                <p class="text-gray-500 mt-1">Antes de ver tu dashboard, necesitamos algunos datos adicionales.</p>
            </div>

            @if(session('warning'))
                <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 mb-6 rounded">
                    <i class="fas fa-exclamation-triangle mr-2"></i> {{ session('warning') }}
                </div>
            @endif

            <form method="POST" action="{{ route('paciente.register.store') }}">
                @csrf
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Teléfono</label>
                        <input type="text" name="telefono" value="{{ old('telefono') }}" class="mt-1 w-full rounded-lg border-gray-300 focus:ring-cyan-500 focus:border-cyan-500" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Código Postal</label>
                        <input type="text" name="codigo_postal" value="{{ old('codigo_postal') }}" class="mt-1 w-full rounded-lg border-gray-300" required>
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700">Calle</label>
                        <input type="text" name="calle" value="{{ old('calle') }}" class="mt-1 w-full rounded-lg border-gray-300" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Número exterior</label>
                        <input type="text" name="numero_exterior" value="{{ old('numero_exterior') }}" class="mt-1 w-full rounded-lg border-gray-300">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Fraccionamiento / Colonia</label>
                        <input type="text" name="fraccionamiento" value="{{ old('fraccionamiento') }}" class="mt-1 w-full rounded-lg border-gray-300">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Género</label>
                        <select name="genero" class="mt-1 w-full rounded-lg border-gray-300" required>
                            <option value="">Selecciona</option>
                            <option value="masculino">Masculino</option>
                            <option value="femenino">Femenino</option>
                            <option value="Sin especificar">Sin especificar</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Fecha de nacimiento</label>
                        <input type="date" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}" class="mt-1 w-full rounded-lg border-gray-300" required>
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <button type="submit" class="bg-cyan-600 hover:bg-cyan-700 text-white px-6 py-2 rounded-lg font-semibold transition">
                        <i class="fas fa-save mr-2"></i> Guardar y continuar
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>