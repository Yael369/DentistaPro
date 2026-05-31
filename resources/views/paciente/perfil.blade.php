<x-app-layout>
    <div class="max-w-5xl mx-auto">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-slate-800">Mi Perfil</h1>
                <p class="text-gray-500 mt-2">Actualiza tu información personal</p>
            </div>
            @if(session('success'))
                <div class="mb-6 bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-xl">
                    {{ session('success') }}
                </div>
            @endif
            @if($errors->any())
                <div class="mb-6 bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded-xl">
                    <ul class="list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('paciente.perfil.update') }}">
                @csrf
                @method('PUT')
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nombre</label>
                        <input
                            type="text"
                            name="nombre"
                            value="{{ old('nombre', $paciente->user->nombre) }}"
                            class="w-full rounded-xl border-gray-300 focus:ring-cyan-500 focus:border-cyan-500"
                        >
                    </div>

                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Apellido paterno</label>
                        <input
                            type="text"
                            name="apellido_paterno"
                            value="{{ old('apellido_paterno', $paciente->user->apellido_paterno) }}"
                            class="w-full rounded-xl border-gray-300 focus:ring-cyan-500 focus:border-cyan-500"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Apellido materno</label>
                        <input
                            type="text"
                            name="apellido_materno"
                            value="{{ old('apellido_materno', $paciente->user->apellido_materno) }}"
                            class="w-full rounded-xl border-gray-300 focus:ring-cyan-500 focus:border-cyan-500"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Teléfono</label>
                        <input
                            type="text"
                            name="telefono"
                            value="{{ old('telefono', $paciente->telefono) }}"
                            class="w-full rounded-xl border-gray-300 focus:ring-cyan-500 focus:border-cyan-500"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Fecha de nacimiento</label>
                        <input
                            type="date"
                            name="fecha_nacimiento"
                            value="{{ old('fecha_nacimiento', optional($paciente->fecha_nacimiento)->format('Y-m-d')) }}"
                            class="w-full rounded-xl border-gray-300 focus:ring-cyan-500 focus:border-cyan-500"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Género</label>
                        <select name="genero" class="w-full rounded-xl border-gray-300 focus:ring-cyan-500 focus:border-cyan-500">
                            <option value="Masculino"
                                {{ $paciente->genero == 'Masculino' ? 'selected' : '' }}>
                                Masculino
                            </option>

                            <option value="Femenino"
                                {{ $paciente->genero == 'Femenino' ? 'selected' : '' }}>
                                Femenino
                            </option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Calle</label>
                        <input
                            type="text"
                            name="calle"
                            value="{{ old('calle', $paciente->calle) }}"
                            class="w-full rounded-xl border-gray-300 focus:ring-cyan-500 focus:border-cyan-500"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Número exterior</label>
                        <input
                            type="text"
                            name="numero_exterior"
                            value="{{ old('numero_exterior', $paciente->numero_exterior) }}"
                            class="w-full rounded-xl border-gray-300 focus:ring-cyan-500 focus:border-cyan-500"
                        >
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Fraccionamiento</label>
                        <input
                            type="text"
                            name="fraccionamiento"
                            value="{{ old('fraccionamiento', $paciente->fraccionamiento) }}"
                            class="w-full rounded-xl border-gray-300 focus:ring-cyan-500 focus:border-cyan-500"
                        >
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Código postal</label>
                        <input
                            type="text"
                            name="codigo_postal"
                            value="{{ old('codigo_postal', $paciente->codigo_postal) }}"
                            class="w-full rounded-xl border-gray-300 focus:ring-cyan-500 focus:border-cyan-500"
                        >
                    </div>
                </div>
                <div class="mt-8">
                    <button type="submit" class="bg-cyan-600 hover:bg-cyan-700 text-white px-6 py-3 rounded-xl transition">
                        Guardar cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

