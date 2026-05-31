<x-guest-layout>

    <div class="text-center mb-8">

        <h1 class="text-4xl font-bold text-cyan-600">
            🦷 Clínica Dental Belinda
        </h1>

        <p class="mt-2 text-gray-600 dark:text-gray-400">
            Bienvenido nuevamente
        </p>

        <p class="text-sm text-gray-500 dark:text-gray-400">
            Inicia sesión para continuar.
        </p>

    </div>

    <!-- Session Status -->
    <x-auth-session-status
        class="mb-4"
        :status="session('status')"
    />

    <form method="POST" action="{{ route('login') }}">

        @csrf

        <!-- EMAIL -->

        <div>

            <x-input-label
                for="email"
                :value="__('Correo electrónico')"
            />

            <x-text-input
                id="email"
                class="block mt-1 w-full rounded-xl"
                type="email"
                name="email"
                :value="old('email')"
                required
                autofocus
            />

            <x-input-error
                :messages="$errors->get('email')"
                class="mt-2"
            />

        </div>

        <!-- PASSWORD -->

        <div class="mt-5">

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

        <!-- REMEMBER -->

        <div class="flex justify-between items-center mt-5">

            <label
                for="remember_me"
                class="inline-flex items-center"
            >

                <input
                    id="remember_me"
                    type="checkbox"
                    class="rounded border-gray-300 text-cyan-600 shadow-sm focus:ring-cyan-500"
                    name="remember"
                >

                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">
                    Recordarme
                </span>

            </label>

            @if (Route::has('password.request'))

                <a
                    class="text-sm text-cyan-600 hover:underline"
                    href="{{ route('password.request') }}"
                >

                    ¿Olvidaste tu contraseña?

                </a>

            @endif

        </div>

        <!-- BOTÓN LOGIN -->

        <div class="mt-6">

            <button
                type="submit"
                class="w-full bg-cyan-600 hover:bg-cyan-700 text-white font-semibold py-3 rounded-xl transition duration-300 shadow-lg"
            >

                Iniciar Sesión

            </button>

        </div>

        <!-- REGISTRO -->

        <div class="text-center mt-6">

            <p class="text-gray-600 dark:text-gray-400">

                ¿No tienes cuenta?

                <a
                    href="{{ route('register') }}"
                    class="text-cyan-600 font-semibold hover:underline"
                >

                    Regístrate

                </a>

            </p>

        </div>

    </form>

</x-guest-layout>