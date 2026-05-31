<x-app-layout>
    <div class="space-y-6">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">Reportes Estadísticos</h1>
            <p class="text-gray-500 mt-2">Visualiza las estadísticas de la clínica</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Citas este año</p>
                        <p class="text-3xl font-bold text-slate-800">{{ $citasPorMes->sum('total') }}</p>
                    </div>
                    <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-calendar-alt text-blue-600 text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Ingresos totales</p>
                        <p class="text-3xl font-bold text-green-600">${{ number_format($ingresosPorMes->sum('total'), 2) }}</p>
                    </div>
                    <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-dollar-sign text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Top tratamientos</p>
                        <p class="text-3xl font-bold text-slate-800">{{ $topTratamientos->count() }}</p>
                    </div>
                    <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-chart-bar text-purple-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <h3 class="font-semibold text-slate-800 mb-4">
                    <i class="fas fa-chart-line text-cyan-600 mr-2"></i>Citas por Mes
                </h3>
                <div class="h-64">
                    <canvas id="citasPorMesChart"></canvas>
                </div>
            </div>

            <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
                <h3 class="font-semibold text-slate-800 mb-4">
                    <i class="fas fa-chart-pie text-cyan-600 mr-2"></i>Citas por Estado
                </h3>
                <div class="h-64">
                    <canvas id="citasPorEstadoChart"></canvas>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <h3 class="font-semibold text-slate-800 mb-4">
                <i class="fas fa-dollar-sign text-cyan-600 mr-2"></i>Ingresos por Mes
            </h3>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="text-left p-3 text-xs font-semibold text-gray-500">Mes</th>
                            <th class="text-left p-3 text-xs font-semibold text-gray-500">Ingresos</th>
                            <th class="text-left p-3 text-xs font-semibold text-gray-500">Citas</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $meses = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
                        @endphp
                        @foreach($ingresosPorMes as $ingreso)
                        <tr class="border-b border-gray-100">
                            <td class="p-3 text-sm">{{ $meses[$ingreso->mes - 1] }}</td>
                            <td class="p-3 text-sm font-semibold text-green-600">${{ number_format($ingreso->total, 2) }}</td>
                            <td class="p-3 text-sm">
                                {{ $citasPorMes->where('mes', $ingreso->mes)->first()->total ?? 0 }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100">
            <h3 class="font-semibold text-slate-800 mb-4">
                <i class="fas fa-star text-cyan-600 mr-2"></i>Top 5 Tratamientos más Realizados
            </h3>
            <div class="space-y-3">
                @foreach($topTratamientos as $tratamiento)
                <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                    <div>
                        <p class="font-medium text-slate-800">{{ $tratamiento->nombre_tratamiento }}</p>
                        <p class="text-xs text-gray-500">${{ number_format($tratamiento->costo, 2) }}</p>
                    </div>
                    <div class="flex items-center gap-2">
                        <span class="text-2xl font-bold text-cyan-600">{{ $tratamiento->citas_count }}</span>
                        <span class="text-xs text-gray-500">citas</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const citasCtx = document.getElementById('citasPorMesChart').getContext('2d');
        new Chart(citasCtx, {
            type: 'line',
            data: {
                labels: @json($citasPorMes->map(function($item) use ($meses) { 
                    return $meses[$item->mes - 1]; 
                })),
                data: @json($citasPorMes->pluck('total')),
                datasets: [{
                    label: 'Citas',
                    data: @json($citasPorMes->pluck('total')),
                    borderColor: '#0ea5e9',
                    backgroundColor: 'rgba(14, 165, 233, 0.1)',
                    tension: 0.4,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
        const estadoCtx = document.getElementById('citasPorEstadoChart').getContext('2d');
        new Chart(estadoCtx, {
            type: 'pie',
            data: {
                labels: @json($citasPorEstado->pluck('estado')),
                datasets: [{
                    data: @json($citasPorEstado->pluck('total')),
                    backgroundColor: ['#eab308', '#22c55e', '#ef4444']
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
</x-app-layout>