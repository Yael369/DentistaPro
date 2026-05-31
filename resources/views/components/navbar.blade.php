{{-- resources/views/components/navbar.blade.php --}}
<nav class="bg-white shadow-md fixed top-0 left-0 right-0 z-50 h-20">
    <div class="h-full px-6 flex justify-between items-center">
        {{-- Logo --}}
        <div class="flex items-center gap-3">
            <div class="text-3xl">
                <i class="fas fa-tooth text-cyan-600"></i>
            </div>
            <div>
                <h1 class="text-cyan-600 font-bold text-xl">Clínica Dental Belinda</h1>
                <p class="text-gray-400 text-xs">
                    <i class="fas fa-calendar-alt mr-1"></i> Sistema de Gestión Dental
                </p>
            </div>
        </div>

        {{-- User menu --}}
        <div class="relative">
            <x-dropdown align="right" width="64">
                <x-slot name="trigger">
                    <button class="flex items-center gap-3 bg-gray-50 hover:bg-gray-100 rounded-xl px-3 py-2 transition">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-r from-cyan-500 to-blue-600 text-white flex items-center justify-center font-bold">
                            {{ strtoupper(substr(Auth::user()->nombre, 0, 1)) }}
                        </div>
                        <div class="text-left hidden md:block">
                            <div class="font-medium text-sm">{{ Auth::user()->nombre }}</div>
                            <div class="text-xs text-gray-400">
                                <i class="fas fa-envelope mr-1"></i> {{ Auth::user()->email }}
                            </div>
                        </div>
                        <i class="fas fa-chevron-down text-gray-400 text-xs hidden md:block"></i>
                    </button>
                </x-slot>
                <x-slot name="content">
                    <x-dropdown-link :href="route('profile.edit')">
                        <i class="fas fa-user-circle mr-2"></i> Mi perfil
                    </x-dropdown-link>
                    <x-dropdown-link :href="route('profile.edit')">
                        <i class="fas fa-cog mr-2"></i> Configuración
                    </x-dropdown-link>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                            <i class="fas fa-sign-out-alt mr-2"></i> Cerrar sesión
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
    </div>
</nav>