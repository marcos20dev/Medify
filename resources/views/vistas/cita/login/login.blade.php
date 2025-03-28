@extends('plantillas.cita.citaplantilla')

@section('title', 'Inicio de sesión')

@section('content')
    <div class="flex items-center justify-center sm:py-40 py-5 min-h-screen">
        <div class="flex flex-wrap max-w-6xl w-full p-8 md:p-6 rounded-lg shadow-md bg-gray-200">
            <!-- Imagen (oculta en dispositivos móviles) -->
            <div class="w-full md:w-1/2 px-1 py-12 hidden md:block">
                <img src="{{ asset('img/hospital.png') }}" alt="Imagen de inicio de sesión"
                     class="w-full h-auto object-cover rounded-lg">
            </div>

            <!-- Formulario -->
            <div class="w-full md:w-1/2 px-4 py-6">
                <div class="flex flex-col items-center">
                    <h1 class="mb-4 text-xl font-semibold text-gray-700">Iniciar sesión</h1>
                    <p class="mb-6 text-gray-500">Ingrese su número de DNI y contraseña para acceder a su cuenta.</p>
                </div>

                <!-- Formulario de inicio de sesión -->
                <form action="{{ route('verificar') }}" method="POST" class="w-full">
                    @csrf
                    <div class="mb-4">
                        <label for="Numdoc" class="mb-2 text-sm font-medium text-gray-700">Número de documento</label>
                        <input id="Numdoc" name="Numdoc" type="text"
                               class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-300"
                               placeholder="Ingrese su número de DNI" required>
                        @error('Numdoc')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="password" class="mb-2 text-sm font-medium text-gray-700">Contraseña</label>
                        <div class="relative flex items-center">
                            <input id="password" name="password" type="password"
                                   class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-1 focus:ring-blue-300"
                                   placeholder="Ingrese su contraseña" required aria-describedby="password-help">
                            <button id="toggle-password-button" type="button"
                                    class="absolute inset-y-0 right-0 px-3 text-gray-400 focus:outline-none"
                                    aria-label="Mostrar u ocultar contraseña" onclick="togglePassword()">
                                <img id="password-icon" src="{{ asset('img/ps.png') }}"
                                     alt="Mostrar/Ocultar contraseña" class="h-6 w-6">
                            </button>
                        </div>
                        <small id="password-help" class="text-gray-500">La contraseña debe contener al menos 8 caracteres.</small>
                        @error('password')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label class="inline-flex items-center">
                            <input type="checkbox" name="recordarme" class="mr-2">
                            <span class="text-sm text-gray-700">Recordarme</span>
                        </label>
                    </div>
                    <button type="submit"
                            class="w-full px-4 py-2 text-sm font-medium text-white bg-red-600 rounded-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500">
                        Iniciar sesión
                    </button>
                </form>

                @if ($errors->has('message'))
                    <div class="mt-4 text-red-500">
                        {{ $errors->first('message') }}
                    </div>
                @endif

                <div class="flex items-center justify-center mt-4">
                    <p class="text-sm text-gray-600">¿No tienes una cuenta?
                        <a href="{{ route('registro') }}" class="ml-1 text-blue-700 hover:underline">Crear cuenta</a></p>
                </div>
            </div>
        </div>
    </div>

    <script>
        function togglePassword() {
            const password = document.getElementById("password");
            const icon = document.getElementById("password-icon");

            if (password.type === "text") {
                password.type = "password";
                icon.src = "{{ asset('img/ps.png') }}";
            } else {
                password.type = "text";
                icon.src = "{{ asset('img/ps-tachado.png') }}";
            }
        }
    </script>
@endsection
