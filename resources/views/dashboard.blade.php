{{-- resources/views/dashboard.blade.php --}}
<x-app-layout>
    <div class="space-y-6">
        {{-- Header con fecha y bienvenida --}}
        <div class="flex justify-between items-center flex-wrap gap-4">
            <div>
                <h1 class="text-3xl font-bold text-slate-800">
                    <i class="fas fa-chart-line text-cyan-600 mr-2"></i>Dashboard
                </h1>
                <p class="text-gray-500 mt-1">
                    <i class="fas fa-user-check mr-1"></i> Bienvenido de vuelta, 
                    <span class="font-semibold text-gray-700">{{ Auth::user()->nombre }}</span>
                </p>
            </div>
            <div class="bg-white px-4 py-2 rounded-lg shadow-sm">
                <i class="fas fa-calendar-alt text-cyan-600 mr-2"></i>
                <span class="text-gray-600">{{ now()->format('l, d \\d\\e F \\d\\e Y') }}</span>
            </div>
        </div>

        {{-- Contenido según el rol --}}
        @if(Auth::user()->rol == 'admin')
            @include('dashboard.admin')
        @elseif(Auth::user()->rol == 'dentista')
            @include('dashboard.dentista')
        @else
            @include('dashboard.paciente')
        @endif
    </div>
</x-app-layout>