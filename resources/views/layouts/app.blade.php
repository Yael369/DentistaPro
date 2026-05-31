{{-- resources/views/layouts/app.blade.php --}}
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Clínica Dental') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>
<body class="bg-slate-100">
    <div class="min-h-screen overflow-hidden">
        <x-navbar />
        
        <div class="flex">
            <x-sidebar :sidebarOpen="true" />
            
            {{-- Main content con margen dinámico --}}
            <main 
                x-data="{ sidebarOpen: true }"
                x-init="$watch('sidebarOpen', value => localStorage.setItem('sidebarOpen', value))"
                x-on:resize.window="sidebarOpen = window.innerWidth >= 768"
                :class="sidebarOpen ? 'ml-64' : 'ml-20'"
                class="flex-1 p-8 mt-20 transition-all duration-300"
            >
                {{ $slot }}
            </main>
        </div>
    </div>
    
    @livewireScripts
    <script>
        // Persistir estado del sidebar
        document.addEventListener('alpine:init', () => {
            Alpine.store('sidebar', {
                open: localStorage.getItem('sidebarOpen') === 'true',
                toggle() {
                    this.open = !this.open;
                    localStorage.setItem('sidebarOpen', this.open);
                }
            });
        });
    </script>
</body>
</html>