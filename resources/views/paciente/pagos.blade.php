<x-app-layout>
    <div class="space-y-6">
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h1 class="text-3xl font-bold text-slate-800">Mis Pagos</h1>
            <p class="text-gray-500 mt-2">Historial de pagos realizados</p>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Pagos realizados</p>
                        <p class="text-3xl font-bold text-slate-800 mt-2">{{ $pagos->count() }}</p>
                    </div>
                    <div class="w-14 h-14 rounded-xl bg-green-100 flex items-center justify-center">
                        <i class="fas fa-dollar-sign text-green-600 text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm">Citas pendientes de pago</p>
                        <p class="text-3xl font-bold text-slate-800 mt-2">{{ $citasPendientesPago }}</p>
                    </div>
                    <div class="w-14 h-14 rounded-xl bg-red-100 flex items-center justify-center">
                        <i class="fas fa-exclamation-circle text-red-600 text-xl"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
            <h2 class="text-xl font-semibold text-slate-800 mb-6">Historial de Pagos</h2>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="border-b border-gray-200 text-left">
                            <th class="pb-3 text-gray-500 font-medium">Fecha</th>
                            <th class="pb-3 text-gray-500 font-medium">Monto</th>
                            <th class="pb-3 text-gray-500 font-medium">Método</th>
                            <th class="pb-3 text-gray-500 font-medium">Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pagos as $pago)
                            <tr class="border-b border-gray-100">
                                <td class="py-4">
                                    {{ \Carbon\Carbon::parse($pago->fecha_pago)->format('d/m/Y') }}
                                </td>
                                <td class="py-4 font-semibold text-slate-800">
                                    ${{ number_format($pago->monto, 2) }}
                                </td>
                                <td class="py-4">
                                    {{ $pago->metodo_pago }}
                                </td>
                                <td class="py-4">
                                    <span class="px-3 py-1 rounded-full text-xs bg-green-100 text-green-700">
                                        Pagado
                                    </span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="py-10 text-center text-gray-500">
                                    No hay pagos registrados
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>