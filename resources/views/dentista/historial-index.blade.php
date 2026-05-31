<x-app-layout>
    <div class="space-y-6">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">Historial Clínico</h1>
            <p class="text-gray-500 mt-2">Busca un paciente para ver su historial completo</p>
        </div>

        {{-- Buscador --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
            <div class="relative">
                <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="text" 
                       id="searchPaciente"
                       placeholder="Buscar por nombre, apellido o email..."
                       class="w-full pl-12 pr-4 py-3 rounded-xl border-gray-300 focus:ring-cyan-500 focus:border-cyan-500">
            </div>
            
            {{-- Resultados --}}
            <div id="resultados" class="mt-4 hidden">
                <h3 class="font-semibold text-slate-700 mb-3">Resultados:</h3>
                <div id="listaPacientes" class="space-y-2"></div>
            </div>
            
            {{-- Mensaje de no resultados --}}
            <div id="noResultados" class="mt-4 text-center text-gray-500 hidden">
                <i class="fas fa-user-slash text-4xl mb-2 block text-gray-300"></i>
                No se encontraron pacientes
            </div>
            
            {{-- Mensaje inicial --}}
            <div id="mensajeInicial" class="mt-4 text-center text-gray-500">
                <i class="fas fa-search text-4xl mb-2 block text-gray-300"></i>
                Escribe el nombre o email del paciente para buscar
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    const searchInput = document.getElementById('searchPaciente');
    const resultadosDiv = document.getElementById('resultados');
    const listaPacientes = document.getElementById('listaPacientes');
    const noResultadosDiv = document.getElementById('noResultados');
    const mensajeInicial = document.getElementById('mensajeInicial');
    
    let timeoutId = null;
    
    searchInput.addEventListener('input', function() {
        clearTimeout(timeoutId);
        const query = this.value.trim();
        
        if(query.length < 2) {
            resultadosDiv.classList.add('hidden');
            noResultadosDiv.classList.add('hidden');
            mensajeInicial.classList.remove('hidden');
            return;
        }
        
        mensajeInicial.classList.add('hidden');
        
        timeoutId = setTimeout(() => {
            buscarPacientes(query);
        }, 300);
    });
    
    function buscarPacientes(query) {
        fetch(`/dentista/buscar-pacientes?q=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                listaPacientes.innerHTML = '';
                
                if(data.length === 0) {
                    resultadosDiv.classList.add('hidden');
                    noResultadosDiv.classList.remove('hidden');
                    return;
                }
                
                noResultadosDiv.classList.add('hidden');
                resultadosDiv.classList.remove('hidden');
                
                data.forEach(paciente => {
                    const nombreCompleto = `${paciente.user.nombre} ${paciente.user.apellido_paterno} ${paciente.user.apellido_materno || ''}`;
                    const card = `
                        <a href="/dentista/historial/${paciente.id}" 
                           class="flex items-center justify-between p-4 border border-gray-100 rounded-xl hover:bg-slate-50 transition group">
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-cyan-100 flex items-center justify-center">
                                    <i class="fas fa-user text-cyan-600 text-lg"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-slate-800 group-hover:text-cyan-600">
                                        ${nombreCompleto}
                                    </p>
                                    <p class="text-sm text-gray-500">${paciente.user.email}</p>
                                    <p class="text-sm text-gray-500">📱 ${paciente.telefono}</p>
                                </div>
                            </div>
                            <div>
                                <i class="fas fa-chevron-right text-gray-400 group-hover:text-cyan-600"></i>
                            </div>
                        </a>
                    `;
                    listaPacientes.innerHTML += card;
                });
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }
</script>