<header x-data="{ open: false }" class="bg-white border-b-2 border-gray-200 fixed top-0 w-full z-10">
    <div class="container mx-auto px-4 py-5 flex justify-between items-center">
        <!-- Logo (sin cambios) -->
        <div class="flex justify-start md:justify-center flex-grow items-center">
            <a href="{{ route('home') }}" class="flex items-center">
                <img src="{{ asset('logo/LOGO LAREDO.png') }}" alt="Logo del Hospital Distrital LAREDO"
                     class="h-12 md:h-16">
                <div class="hidden md:flex flex-col ml-3">
                    <h1 class="text-lg md:text-xl font-semibold text-gray-800">Hospital Distrital LAREDO</h1>
                    <p class="text-xs text-gray-600">Cuidando tu salud</p>
                </div>
            </a>
        </div>

        <!-- Navegación desktop (sin cambios) -->
        <nav class="flex-grow flex justify-center items-center space-x-10">

            <ul class="nav-links hidden md:flex flex-col md:flex-row md:items-center md:ml-auto mx-auto">

                <a href="{{ route('home') }}"
                   class="relative px-4 py-2 rounded-lg transition-transform duration-300 transform hover:scale-110 {{ request()->routeIs('home') ? 'text-gray-800 font-semibold' : 'text-gray-700 hover:text-gray-900' }}">
                    Inicio
                    <span
                        class="{{ request()->routeIs('home') ? 'block' : 'hidden' }} h-1 bg-custom-color absolute bottom-0 left-0 right-0"></span>
                </a>

                <a href="{{ route('consulta.dni') }}"
                   class="relative px-4 py-2 rounded-lg transition-transform duration-300 transform hover:scale-110 {{ request()->routeIs('consulta.dni') ? 'text-gray-800 font-semibold' : 'text-gray-700 hover:text-gray-900' }}">
                    Consulta de cita
                    <span
                        class="{{ request()->routeIs('consulta.dni') ? 'block' : 'hidden' }} h-1  bg-custom-color absolute bottom-0 left-0 right-0"></span>
                </a>

                <a href="{{ route('nosotros') }}"
                   class="relative px-4 py-2 rounded-lg transition-transform duration-300 transform hover:scale-110 {{ request()->routeIs('nosotros') ? 'text-gray-800 font-semibold' : 'text-gray-700 hover:text-gray-900' }}">
                    Nosotros
                    <span
                        class="{{ request()->routeIs('nosotros') ? 'block' : 'hidden' }} h-1  bg-custom-color absolute bottom-0 left-0 right-0"></span>
                </a>


                <a href="{{ route('especialidades') }}"
                   class="relative px-4 py-2 rounded-lg transition-transform duration-300 transform hover:scale-110 {{ request()->routeIs('especialidades') ? 'text-gray-800 font-semibold' : 'text-gray-700 hover:text-gray-900' }}">
                    Especialidades
                    <span
                        class="{{ request()->routeIs('especialidades') ? 'block' : 'hidden' }} h-1  bg-custom-color absolute bottom-0 left-0 right-0"></span>
                </a>

                <a href="{{ route('noticias') }}"
                   class="relative px-4 py-2 rounded-lg transition-transform duration-300 transform hover:scale-110 {{ request()->routeIs('noticias') ? 'text-gray-800 font-semibold' : 'text-gray-700 hover:text-gray-900' }}">
                    Noticias
                    <span
                        class="{{ request()->routeIs('noticias') ? 'block' : 'hidden' }} h-1  bg-custom-color absolute bottom-0 left-0 right-0"></span>
                </a>

                <a href="{{ route('contactanos') }}"
                   class="relative px-4 py-2 rounded-lg transition-transform duration-300 transform hover:scale-110 {{ request()->routeIs('contactanos') ? 'text-gray-800 font-semibold' : 'text-gray-700 hover:text-gray-900' }}">
                    Contacto
                    <span
                        class="{{ request()->routeIs('contactanos') ? 'block' : 'hidden' }} h-1 bg-custom-color absolute bottom-0 left-0 right-0"></span>
                </a>

                <div class="bg-gray-400 w-px h-8 self-center mx-3"></div>

                <div class="flex space-x-1">
                    <a href="{{ route('login') }}"
                       class="px-2 py-2 rounded-full text-white bg-gray-800 transition-colors duration-300">Iniciar
                        sesión</a>
                    <a href="{{ route('registro') }}"
                       class="px-2 py-2 rounded-full text-white bg-red-500 transition-colors duration-300">Crear
                        cuenta</a>
                </div>

            </ul>

        </nav>


        <!-- Botón móvil mejorado -->
        <div class="md:hidden flex items-center">
            <button @click="open = !open"
                    aria-label="Menú de navegación"
                    aria-expanded="open"
                    class="inline-flex items-center justify-center p-3 rounded-md text-gray-800 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 transition">
                <svg x-show="!open" class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                </svg>
                <svg x-show="open" class="h-7 w-7" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>

    <!-- Menú móvil mejorado -->
    <div x-show="open"
         x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-0 translate-y-1"
         x-transition:enter-end="opacity-100 translate-y-0"
         x-transition:leave="transition ease-in duration-150"
         x-transition:leave-start="opacity-100 translate-y-0"
         x-transition:leave-end="opacity-0 translate-y-1"
         x-cloak
         class="md:hidden fixed inset-x-0 top-20 bg-white shadow-lg rounded-b-lg mx-4 overflow-y-auto max-h-[calc(100vh-5rem)]"
         @click.away="open = false">

        <div class="px-4 py-3 space-y-1">
            <!-- Elementos del menú con mejor feedback táctil -->
            <a href="{{ route('home') }}"
               class="flex items-center px-4 py-3 rounded-lg text-lg font-medium hover:bg-gray-50 active:bg-gray-100 transition-colors
                      {{ request()->routeIs('home') ? 'text-gray-800 font-semibold bg-gray-50' : 'text-gray-700' }}">
                <span class="mr-3 w-6 text-center"><i class="fas fa-home text-gray-800"></i></span>
                Inicio
            </a>
            <hr class="border-gray-200">

            <a href="{{ route('consulta.dni') }}"
               class="flex items-center px-4 py-3 rounded-lg text-lg font-medium transition-all duration-200 hover:bg-gray-50 active:bg-gray-100
          {{ request()->routeIs('consulta.dni') ? 'text-gray-800 font-semibold bg-gray-50' : 'text-gray-700' }}">
    <span class="mr-3 w-6 text-center">
        <i class="fas fa-calendar-check text-gray-800"></i> {{-- Cambia el ícono según la sección --}}
    </span>
                Consulta de cita
            </a>

            <hr class="border-gray-200">

            <a href="{{ route('nosotros') }}"
               class="flex items-center px-4 py-3 rounded-lg text-lg font-medium hover:bg-gray-50 active:bg-gray-100 transition-colors
                      {{ request()->routeIs('nosotros') ? 'text-gray-800 font-semibold bg-gray-50' : 'text-gray-700' }}">
                <span class="mr-3 w-6 text-center"><i class="fas fa-users text-gray-800"></i></span>
                Nosotros
            </a>

            <hr class="border-gray-200">

            <a href="{{ route('especialidades') }}"
               class="flex items-center px-4 py-3 rounded-lg text-lg font-medium "{{ request()->routeIs('especialidades') ? 'text-gray-800 font-semibold' : 'text-gray-700 hover:text-gray-900' }}
            ">
            <span class="mr-3"><i class="fas fa-briefcase-medical text-gray-800"></i></span>
            Especialidades
            <span
                class="{{ request()->routeIs('especialidades') ? 'block' : 'hidden' }} h-1  bg-custom-color absolute bottom-0 left-0 right-0"></span>
            </a>
            <hr class="border-gray-200">
            <a href="{{ route('noticias') }}"
               class="flex items-center px-4 py-3 rounded-lg text-lg font-medium "{{ request()->routeIs('noticias') ? 'text-gray-800 font-semibold' : 'text-gray-700 hover:text-gray-900' }}
            ">
            <span class="mr-3"><i class="fas fa-newspaper text-gray-800"></i></span>
            Noticias
            <span
                class="{{ request()->routeIs('noticias') ? 'block' : 'hidden' }} h-1  bg-custom-color absolute bottom-0 left-0 right-0"></span>
            </a>
            <hr class="border-gray-200">
            <a href="{{ route('contactanos') }}" class="flex items-center px-4 py-3 rounded-lg text-lg font-medium "
            {{ request()->routeIs('contactanos') ? 'text-gray-800 font-semibold' : 'text-gray-700 hover:text-gray-900' }}
            ">
            <span class="mr-3"><i class="fas fa-envelope text-gray-800"></i></span>
            Contacto
            <span
                class="{{ request()->routeIs('contactanos') ? 'block' : 'hidden' }} h-1 bg-custom-color absolute bottom-0 left-0 right-0"></span>
            </a>
            <hr class="border-gray-200">
            <br>
            <!-- Repetir patrón para otros elementos del menú -->
            <div class="flex justify-center gap-4 my-2">
                <a href="{{ route('login') }}"
                   class="px-3 py-2 rounded-full text-white bg-gray-800 transition-colors duration-300">
                    Iniciar sesión
                </a>
                <a href="{{ route('registro') }}"
                   class="px-3 py-2 rounded-full text-white bg-red-500 transition-colors duration-300">
                    Crear cuenta
                </a>
            </div>
            <br>

        </div>
    </div>
</header>

<!-- Estilos (sin cambios) -->
<style>
    .bg-custom-color {
        background-color: rgb(3, 194, 194);
    }

    [x-cloak] {
        display: none !important;
    }
</style>

<!-- Dependencias (sin cambios) -->
<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.x" defer></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
