{{-- resources/views/components/sidebar.blade.php --}}
<aside 
    id="sidebar"
    class="bg-gradient-to-b from-slate-900 to-slate-800 text-white fixed left-0 top-20 h-[calc(100vh-5rem)] transition-all duration-300 z-40 shadow-2xl overflow-y-auto w-70"
>
    <div class="absolute -right-1 top-6">
        <button 
            id="sidebarToggle"
            class="bg-cyan-600 hover:bg-cyan-700 text-white w-6 h-6 rounded-full flex items-center justify-center text-xs shadow-lg transition-transform duration-300"
        >
            <i class="fas fa-chevron-left"></i>
        </button>
    </div>

    <div class="p-5">
        <div class="mb-6">
            <h2 class="uppercase text-xs text-cyan-400 tracking-wider font-semibold">
                <i class="fas fa-bars mr-2"></i> 
                <span class="title-text">Menú principal</span>
            </h2>
        </div>

        <div class="space-y-1.5">
            @php $rol = Auth::user()->rol; @endphp

            @if($rol == 'admin')
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all duration-200 text-slate-300 hover:bg-slate-800 hover:text-white">
                    <i class="fas fa-chart-line text-lg w-5"></i>
                    <span class="menu-text">Dashboard</span>
                </a>
                <a href="{{ route('admin.usuarios') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all duration-200 text-slate-300 hover:bg-slate-800 hover:text-white">
                    <i class="fas fa-users text-lg w-5"></i>
                    <span class="menu-text">Usuarios</span>
                </a>
                <a href="{{ route('admin.dentistas') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all duration-200 text-slate-300 hover:bg-slate-800 hover:text-white">
                    <i class="fas fa-tooth text-lg w-5"></i>
                    <span class="menu-text">Dentistas</span>
                </a>
                <a href="{{ route('admin.pacientes') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all duration-200 text-slate-300 hover:bg-slate-800 hover:text-white">
                    <i class="fas fa-heartbeat text-lg w-5"></i>
                    <span class="menu-text">Pacientes</span>
                </a>
                <a href="{{ route('admin.citas') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all duration-200 text-slate-300 hover:bg-slate-800 hover:text-white">
                    <i class="fas fa-calendar-alt text-lg w-5"></i>
                    <span class="menu-text">Citas</span>
                </a>
                <a href="{{ route('admin.reportes') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all duration-200 text-slate-300 hover:bg-slate-800 hover:text-white">
                    <i class="fas fa-chart-bar text-lg w-5"></i>
                    <span class="menu-text">Reportes</span>
                </a>
                <a href="{{ route('admin.configuracion') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all duration-200 text-slate-300 hover:bg-slate-800 hover:text-white">
                    <i class="fas fa-cog text-lg w-5"></i>
                    <span class="menu-text">Configuración</span>
                </a>
            @elseif($rol == 'dentista')
                <a href="{{ route('dentista.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all duration-200 text-slate-300 hover:bg-slate-800 hover:text-white">
                    <i class="fas fa-chart-line text-lg w-5"></i>
                    <span class="menu-text">Dashboard</span>
                </a>
                <a href="{{ route('dentista.citas') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all duration-200 text-slate-300 hover:bg-slate-800 hover:text-white">
                    <i class="fas fa-calendar-check text-lg w-5"></i>
                    <span class="menu-text">Mis citas</span>
                </a>
                <a href="{{ route('dentista.pacientes') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all duration-200 text-slate-300 hover:bg-slate-800 hover:text-white">
                    <i class="fas fa-user-md text-lg w-5"></i>
                    <span class="menu-text">Pacientes</span>
                </a>
                <a href="{{ route('dentista.consultas') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all duration-200 text-slate-300 hover:bg-slate-800 hover:text-white">
                    <i class="fas fa-stethoscope text-lg w-5"></i>
                    <span class="menu-text">Consultas</span>
                </a>
                <a href="{{ route('dentista.historial') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all duration-200 text-slate-300 hover:bg-slate-800 hover:text-white">
                    <i class="fas fa-notes-medical text-lg w-5"></i>
                    <span class="menu-text">Historial clínico</span>
                </a>
            @else
                <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all duration-200 text-slate-300 hover:bg-slate-800 hover:text-white">
                    <i class="fas fa-chart-line text-lg w-5"></i>
                    <span class="menu-text">Dashboard</span>
                </a>
                <a href="{{ route('paciente.perfil')}}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all duration-200 text-slate-300 hover:bg-slate-800 hover:text-white">
                    <i class="fas fa-user-circle text-lg w-5"></i>
                    <span class="menu-text">Mi perfil</span>
                </a>
                <a href="{{ route('paciente.citas') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all duration-200 text-slate-300 hover:bg-slate-800 hover:text-white">
                    <i class="fas fa-calendar-plus text-lg w-5"></i>
                    <span class="menu-text">Mis citas</span>
                </a>
                <a href="{{ route('paciente.pagos') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-lg transition-all duration-200 text-slate-300 hover:bg-slate-800 hover:text-white">
                    <i class="fas fa-credit-card text-lg w-5"></i>
                    <span class="menu-text">Pagos</span>
                </a>
            @endif
        </div>

        <div class="absolute bottom-5 left-0 right-0 px-5">
            <div class="border-t border-slate-700 pt-4 mt-4">
                <div class="text-xs text-slate-500 text-center">
                    <i class="fas fa-shield-alt mr-1"></i> 
                    <span class="footer-text">v1.0.0</span>
                </div>
            </div>
        </div>
    </div>
</aside>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const sidebar = document.getElementById('sidebar');
        const toggleBtn = document.getElementById('sidebarToggle');
        
        const titleText = document.querySelector('.title-text');
        const footerText = document.querySelector('.footer-text');
        const allMenuTexts = document.querySelectorAll('.menu-text');
        
        let isOpen = localStorage.getItem('sidebarOpen') !== 'false';
        
        function setSidebarState(open) {
            if (open) {
                sidebar.classList.remove('w-20');
                sidebar.classList.add('w-64');
                toggleBtn.classList.remove('rotate-180');
                if (titleText) titleText.style.display = 'inline';
                if (footerText) footerText.style.display = 'inline';
                allMenuTexts.forEach(text => text.style.display = 'inline');
            } else {
                sidebar.classList.remove('w-64');
                sidebar.classList.add('w-20');
                toggleBtn.classList.add('rotate-180');
                if (titleText) titleText.style.display = 'none';
                if (footerText) footerText.style.display = 'none';
                allMenuTexts.forEach(text => text.style.display = 'none');
            }
        }
        
        setSidebarState(isOpen);
        
        toggleBtn.addEventListener('click', function() {
            isOpen = !isOpen;
            setSidebarState(isOpen);
            localStorage.setItem('sidebarOpen', isOpen);
            
            // Ajustar el main content
            const mainContent = document.getElementById('mainContent');
            if (mainContent) {
                if (isOpen) {
                    mainContent.classList.remove('ml-20');
                    mainContent.classList.add('ml-64');
                } else {
                    mainContent.classList.remove('ml-64');
                    mainContent.classList.add('ml-20');
                }
            }
        });
    });
</script>