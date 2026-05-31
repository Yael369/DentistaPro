<x-guest-layout>

    <div class="text-center mb-8">

        <h1 class="text-4xl font-bold text-cyan-600">
            🦷 Clínica Dental Belinda
        </h1>

        <p class="mt-2 text-gray-600 dark:text-gray-400">
            Crea tu cuenta
        </p>

        <p class="text-sm text-gray-500 dark:text-gray-400">
            Regístrate para acceder al sistema dental.
        </p>

    </div>

    <form method="POST" action="{{ route('register') }}">

        @csrf

        <!-- Nombre -->

        <div>

            <x-input-label
                for="nombre"
                :value="__('Nombre')"
            />

            <x-text-input
                id="nombre"
                class="block mt-1 w-full rounded-xl"
                type="text"
                name="nombre"
                :value="old('nombre')"
                required
                autofocus
            />

            <x-input-error
                :messages="$errors->get('nombre')"
                class="mt-2"
            />

        </div>

        <!-- Apellido Paterno -->

        <div class="mt-4">

            <x-input-label
                for="apellido_paterno"
                :value="__('Apellido Paterno')"
            />

            <x-text-input
                id="apellido_paterno"
                class="block mt-1 w-full rounded-xl"
                type="text"
                name="apellido_paterno"
                :value="old('apellido_paterno')"
                required
            />

            <x-input-error
                :messages="$errors->get('apellido_paterno')"
                class="mt-2"
            />

        </div>

        <!-- Apellido Materno -->

        <div class="mt-4">

            <x-input-label
                for="apellido_materno"
                :value="__('Apellido Materno')"
            />

            <x-text-input
                id="apellido_materno"
                class="block mt-1 w-full rounded-xl"
                type="text"
                name="apellido_materno"
                :value="old('apellido_materno')"
                required
            />

            <x-input-error
                :messages="$errors->get('apellido_materno')"
                class="mt-2"
            />

        </div>

        <!-- Email -->

        <div class="mt-4">

            <x-input-label
                for="email"
                :value="__('Correo Electrónico')"
            />

            <x-text-input
                id="email"
                class="block mt-1 w-full rounded-xl"
                type="email"
                name="email"
                :value="old('email')"
                required
            />

            <x-input-error
                :messages="$errors->get('email')"
                class="mt-2"
            />

        </div>

        <!-- Contraseña -->

        <div class="mt-4">

            <x-input-label
                for="password"
                :value="__('Contraseña')"
            />

            <x-text-input
                id="password"
                class="block mt-1 w-full rounded-xl"
                type="password"
                name="password"
                required
            />

            <x-input-error
                :messages="$errors->get('password')"
                class="mt-2"
            />

        </div>

        <!-- Confirmar Contraseña -->

        <div class="mt-4">

            <x-input-label
                for="password_confirmation"
                :value="__('Confirmar Contraseña')"
            />

            <x-text-input
                id="password_confirmation"
                class="block mt-1 w-full rounded-xl"
                type="password"
                name="password_confirmation"
                required
            />

            <x-input-error
                :messages="$errors->get('password_confirmation')"
                class="mt-2"
            />

        </div>

        <!-- BOTÓN REGISTRAR -->

        <div class="mt-6">

            <button
                type="submit"
                class="w-full bg-cyan-600 hover:bg-cyan-700 text-white font-semibold py-3 rounded-xl shadow-lg transition duration-300"
            >

                Registrarse

            </button>

        </div>

        <!-- LOGIN -->

        <div class="text-center mt-6">

            <p class="text-gray-600 dark:text-gray-400">

                ¿Ya tienes cuenta?

                <a
                    href="{{ route('login') }}"
                    class="text-cyan-600 font-semibold hover:underline"
                >

                    Inicia sesión

                </a>

            </p>

        </div>

    </form>

</x-guest-layout>