<x-app-layout>
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <h1 class="text-2xl font-bold text-slate-800 mb-2">Reprogramar cita</h1>
            <p class="text-gray-500 mb-6">Cambia la fecha, hora o dentista de tu cita.</p>

            <form method="POST" action="{{ route('citas.actualizar', $cita->id) }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Dentista</label>
                    <select name="id_dentista" class="w-full rounded-lg border-gray-300" required>
                        @foreach($dentistas as $dentista)
                            <option value="{{ $dentista->id }}" {{ old('id_dentista', $cita->id_dentista) == $dentista->id ? 'selected' : '' }}>
                                Dr(a). {{ $dentista->user->nombre }} {{ $dentista->user->apellido_paterno }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Fecha</label>
                    <input type="date" name="fecha" value="{{ old('fecha', $cita->fecha) }}" min="{{ date('Y-m-d') }}" class="w-full rounded-lg border-gray-300" required>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Hora</label>
                    <input type="time" name="hora" value="{{ old('hora', $cita->hora) }}" class="w-full rounded-lg border-gray-300" required>
                </div>

                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Motivo (opcional)</label>
                    <textarea name="motivo" rows="3" class="w-full rounded-lg border-gray-300">{{ old('motivo', $cita->motivo) }}</textarea>
                </div>

                <div class="flex justify-end gap-3">
                    <a href="{{ route('paciente.citas') }}" class="px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">Cancelar</a>
                    <button type="submit" class="px-4 py-2 bg-cyan-600 text-white rounded-lg hover:bg-cyan-700">Guardar cambios</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>