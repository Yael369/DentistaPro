<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clínica Dental Belinda</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-r from-cyan-100 via-white to-blue-100 min-h-screen">

    {{-- NAVBAR --}}
    <header class="flex justify-between items-center p-6">

        <div class="flex items-center gap-3">
            <div class="bg-cyan-600 text-white w-12 h-12 rounded-full flex items-center justify-center text-2xl">
                🦷
            </div>

            <div>
                <h1 class="text-2xl font-bold text-cyan-700">
                    Clínica Dental Belinda
                </h1>

                <p class="text-gray-500 text-sm">
                    Tu sonrisa es nuestra prioridad
                </p>
            </div>
        </div>

        <div class="flex gap-4">

            <a href="{{ route('login') }}"
               class="bg-cyan-600 hover:bg-cyan-700 text-white px-5 py-2 rounded-lg transition">
                Iniciar Sesión
            </a>

            <a href="{{ route('register') }}"
               class="border border-cyan-600 text-cyan-700 hover:bg-cyan-600 hover:text-white px-5 py-2 rounded-lg transition">
                Registrarse
            </a>

        </div>

    </header>

    {{-- CONTENIDO PRINCIPAL --}}
    <main class="container mx-auto px-6 py-16">

        <div class="grid lg:grid-cols-2 gap-12 items-center">

            {{-- TEXTO --}}
            <div>

                <h2 class="text-5xl font-bold text-gray-800 leading-tight mb-6">
                    Bienvenido a
                    <span class="text-cyan-600">
                        Clínica Dental Belinda
                    </span>
                </h2>

                <p class="text-lg text-gray-600 mb-8">
                    Brindamos atención dental profesional,
                    moderna y confiable para cuidar tu salud bucal
                    y devolverte la mejor sonrisa.
                </p>

                <div class="flex gap-5">

                    <a href="{{ route('login') }}"
                       class="bg-cyan-600 text-white px-8 py-4 rounded-xl shadow-lg hover:bg-cyan-700 transition">

                        Iniciar Sesión
                    </a>

                    <a href="{{ route('register') }}"
                       class="bg-white border-2 border-cyan-600 text-cyan-700 px-8 py-4 rounded-xl shadow-lg hover:bg-cyan-50 transition">

                        Crear Cuenta
                    </a>

                </div>

            </div>

            {{-- IMAGEN / TARJETA --}}
            <div class="flex justify-center">

                <div class="bg-white shadow-2xl rounded-3xl p-10 max-w-md">

                    <div class="text-center">

                        <div class="text-7xl mb-4">
                            🦷
                        </div>

                        <h3 class="text-3xl font-bold text-cyan-700 mb-4">
                            Sonrisas Saludables
                        </h3>

                        <p class="text-gray-600 mb-6">
                            Agenda tus consultas, administra tu perfil
                            y lleva un mejor control de tu atención dental.
                        </p>

                        <ul class="space-y-4 text-left">

                            <li class="flex items-center gap-3">
                                ✔️ Consultas dentales
                            </li>

                            <li class="flex items-center gap-3">
                                ✔️ Historial clínico
                            </li>

                            <li class="flex items-center gap-3">
                                ✔️ Gestión de citas
                            </li>

                            <li class="flex items-center gap-3">
                                ✔️ Atención profesional
                            </li>

                        </ul>

                    </div>

                </div>

            </div>

        </div>

    </main>

</body>
</html>