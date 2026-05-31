<x-app-layout>
    <div class="space-y-6">
        <div>
            <h1 class="text-3xl font-bold text-slate-800">Usuarios del Sistema</h1>
            <p class="text-gray-500 mt-2">Gestiona todos los usuarios registrados</p>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-xl">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">Usuario</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">Email</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">Rol</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-slate-500 uppercase">Registro</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($usuarios as $usuario)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full 
                                            @if($usuario->rol == 'admin') bg-purple-100
                                            @elseif($usuario->rol == 'dentista') bg-cyan-100
                                            @else bg-green-100
                                            @endif
                                            flex items-center justify-center">
                                            <i class="fas fa-user 
                                                @if($usuario->rol == 'admin') text-purple-600
                                                @elseif($usuario->rol == 'dentista') text-cyan-600
                                                @else text-green-600
                                                @endif"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium text-slate-800">
                                                {{ $usuario->nombre }} {{ $usuario->apellido_paterno }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-slate-700">{{ $usuario->email }}</td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 rounded-full text-xs font-semibold
                                        @if($usuario->rol == 'admin') bg-purple-100 text-purple-700
                                        @elseif($usuario->rol == 'dentista') bg-cyan-100 text-cyan-700
                                        @else bg-green-100 text-green-700
                                        @endif">
                                        {{ ucfirst($usuario->rol) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-slate-700">{{optional($usuario->created_at)->format('d/m/Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                    No hay usuarios registrados
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="p-4 border-t border-gray-100">
                {{ $usuarios->links() }}
            </div>
        </div>
    </div>
</x-app-layout>