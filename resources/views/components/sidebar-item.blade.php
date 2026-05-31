{{-- resources/views/components/sidebar-item.blade.php --}}
@props(['icon', 'href', 'active' => false])

<a 
    href="{{ $href }}" 
    class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all duration-200 group {{ $active ? 'bg-cyan-600 text-white shadow-md' : 'text-slate-300 hover:bg-slate-800 hover:text-white' }}"
>
    <i class="{{ $icon }} text-lg w-5"></i>
    
    {{-- Este es el span que muestra el texto --}}
    <span class="sidebar-item-text whitespace-nowrap">
        {{ $slot }}
    </span>

    {{-- Tooltip para cuando está colapsado --}}
    <div class="sidebar-tooltip hidden group-hover:block absolute left-full ml-2 px-2 py-1 bg-slate-800 text-white text-xs rounded whitespace-nowrap z-50 shadow-lg">
        {{ $slot }}
    </div>
</a>