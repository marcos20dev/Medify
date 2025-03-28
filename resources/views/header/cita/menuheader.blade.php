<header x-data="{ open: false }" class="bg-white border-b-2 border-gray-200 fixed top-0 w-full z-10">

    <div class="container mx-auto px-4 py-5 flex justify-between items-center">
        <!-- Logo y texto más centrados dentro del contenedor COLOAR EN CASO SEA NECESAROI
      flex-shrink-0  -->
        <div class="flex justify-start md:justify-center flex-grow items-center">
            <a href="{{ route('home') }}" class="flex items-center">
                <img src="{{ asset('logo/LOGO LAREDO.png') }}" alt="Logo del Hospital Distrital LAREDO" class="h-12 md:h-16">
                <div class="hidden md:flex flex-col ml-3">
                    <h1 class="text-lg md:text-xl font-semibold text-gray-800">Hospital Distrital LAREDO</h1>
                    <p class="text-xs text-gray-600">Cuidando tu salud</p>
                </div>
            </a>
        </div>
        <div class="md:hidden flex items-center">
            <button @click="open = !open"
                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-800 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-800 transition">
                <svg x-show="!open" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
                <svg x-show="open" class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

    </div>

    <div x-show="open" x-transition:enter="transition ease-out duration-200"
         x-transition:enter-start="opacity-80 scale-95" x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75" x-transition:leave-start="opacity-0 scale-100"
         x-transition:leave-end="opacity-0 scale-95" class="md:hidden ">

        <div class="px-5 py-4 shadow-xl rounded-lg transform transition-all duration-300 scale-100 opacity-100">

            <a href="{{ route('login') }}" class="flex items-center px-4 py-3 rounded-lg text-lg font-medium"
            {{ request()->routeIs('login') ? 'text-gray-800 font-semibold' : 'text-gray-700 hover:text-gray-900' }}">

            <span class="mr-3"><i class="fas fa-sign-in-alt text-gray-800"></i></span>
            <!-- Icono para inicio de sesión -->
            Iniciar con nueva cuenta
            <span
                class="{{ request()->routeIs('login') ? 'block' : 'hidden' }} absolute bottom-0 left-0 right-0 h-1 bg-custom-color"></span>
            </a>
            <hr class="my-1">

            <a href="{{ route('registro') }}" class="flex items-center px-4 py-3 rounded-lg text-lg font-medium"
            {{ request()->routeIs('registro') ? 'text-gray-800 font-semibold' : 'text-gray-700 hover:text-gray-900' }}">

            <span class="mr-3"><i class="fas fa-user-plus text-gray-800"></i></span> <!-- Icono para registro -->
            Crear nueva cuenta nueva
            <span
                class="{{ request()->routeIs('registro') ? 'block' : 'hidden' }} h-1 bg-custom-color absolute bottom-0 left-0 right-0"></span>
            </a>
            <hr class="my-1">

            <a href="{{ route('home') }}" class="flex items-center px-4 py-3 rounded-lg text-lg font-medium"
            {{ request()->routeIs('home') ? 'text-gray-800 font-semibold' : 'text-gray-700 hover:text-gray-900' }}">

            <span class="mr-3"><i class="fas fa-home text-gray-800"></i></span>
            <!-- Icono para página de inicio -->
            Página de inicio
            <span
                class="{{ request()->routeIs('home') ? 'block' : 'hidden' }} h-1 bg-custom-color absolute bottom-0 left-0 right-0"></span>
            </a>

            <hr class="my-1">
            <form action="{{ route('logout') }}" method="POST" style="all:unset;">
                @csrf
                <button type="submit"
                        class="flex items-center px-4 py-3 rounded-lg text-lg font-medium text-red-500 hover:text-red-700 focus:outline-none">
                    <span class="mr-3"><i class="fas fa-sign-out-alt text-red-500"></i></span>
                    Cerrar sesión
                </button>
            </form>




            <br>

        </div>
</header>



<style>
    .bg-custom-color {
        background-color: rgb(3, 194, 194);
    }
</style>


<link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.2/dist/tailwind.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/alpinejs@2.x" defer></script>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
