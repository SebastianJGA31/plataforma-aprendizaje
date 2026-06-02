<x-guest-layout>
    <h2 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Registro de Alumno</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div>
            <x-input-label for="name" value="Nombre completo" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="numero_control" value="Número de control (8 dígitos)" />
            <x-text-input id="numero_control" class="block mt-1 w-full" type="text" name="numero_control" maxlength="8" :value="old('numero_control')" required />
            <x-input-error :messages="$errors->get('numero_control')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" value="Correo electrónico" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="carrera_id" value="Carrera" />
            <select id="carrera_id" name="carrera_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm" required>
                <option value="">Seleccione una carrera</option>
                @foreach($carreras as $carrera)
                    <option value="{{ $carrera->id }}" {{ old('carrera_id') == $carrera->id ? 'selected' : '' }}>
                        {{ $carrera->nombre }}
                    </option>
                @endforeach
            </select>
            <x-input-error :messages="$errors->get('carrera_id')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="semestre" value="Semestre" />
            <x-text-input id="semestre" class="block mt-1 w-full" type="number" name="semestre" min="1" max="14" :value="old('semestre')" required />
            <x-input-error :messages="$errors->get('semestre')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="telefono" value="Teléfono (10 dígitos)" />
            <x-text-input id="telefono" class="block mt-1 w-full" type="text" name="telefono" maxlength="10" :value="old('telefono')" required />
            <x-input-error :messages="$errors->get('telefono')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" value="Contraseña" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" value="Confirmar contraseña" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 dark:text-gray-400" href="{{ route('login') }}">
                ¿Ya tienes cuenta? Inicia sesión
            </a>

            <x-primary-button class="ms-4">
                Registrarse
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
