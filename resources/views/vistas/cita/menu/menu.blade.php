@extends('plantillas.cita.plantillamenu')

@section('title', 'Menu')

@section('cita')

    <div class="mt-20 lg:mt-28 px-4 lg:px-2">

        <div class="flex flex-col lg:flex-row gap-4">
            <!-- Cuadro de Datos del Usuario -->
            <div id="userProfile" class="bg-white shadow-md rounded-lg p-6 lg:w-1/5 w-full lg:mr-4 lg:flex-shrink-0 hidden lg:block">
                <div class="mt-4">
                    <img class="h-20 w-20 rounded-full mx-auto lg:mx-0 lg:mr-4" src="{{ asset('img/userm.png') }}" alt="Foto de perfil">
                    <div class="text-center lg:text-left">
                        <p class="font-semibold text-lg">{{ $usuario->Nombre }} {{ $usuario->ApePaterno }} {{ $usuario->ApeMaterno }}</p>
                        <p class="text-sm text-gray-600">Correo electrónico: {{ $usuario->Gmail }}</p>
                    </div>
                </div>

                <div class="mt-4">
                    <ul class="text-sm text-gray-700 space-y-2">
                        <li><i class="fas fa-venus-mars"></i> Género: {{ $usuario->Genero }}</li>
                        <li><i class="fas fa-id-card"></i> {{ $usuario->TipoDoc }}: {{ $usuario->Numdoc }}</li>
                        <li><i class="fas fa-birthday-cake"></i> Fecha de nacimiento: {{ $usuario->Fechanac }}</li>
                        <li><i class="fas fa-map-marker-alt"></i> Región: {{ $usuario->region ? $usuario->region->Region : 'No disponible' }}</li>
                        <li><i class="fas fa-map-marker-alt"></i> Provincia: {{ $usuario->provincia ? $usuario->provincia->Provincia : 'No disponible' }}</li>
                        <li><i class="fas fa-map-marker-alt"></i> Distrito: {{ $usuario->distrito ? $usuario->distrito->Distrito : 'No disponible' }}</li>
                        <li><i class="fas fa-home"></i> Dirección: {{ $usuario->Direccion }}</li>
                        <li><i class="fas fa-envelope"></i> Correo: {{ $usuario->Gmail }}</li>
                    </ul>
                    <form action="{{ route('logout') }}" method="POST" style="all:unset; margin-top: auto;">
                        @csrf
                        <button type="submit" class="flex items-center px-4 py-3 rounded-lg text-lg font-medium text-red-500 hover:text-red-700 focus:outline-none">
                            <span class="mr-3"><i class="fas fa-sign-out-alt text-red-500"></i></span>
                            Cerrar sesión
                        </button>
                    </form>
                </div>
            </div>



            <div class="flex flex-col w-full">
                <!-- Botones Superiores -->
                <div class="w-full mb-3 lg:overflow-x-auto lg:flex lg:justify-start space-y-4 lg:space-y-0 lg:flex-nowrap lg:space-x-4 mt-8 sm:mt-4">
                    <a id="btnReservarCita" class="button custom-button active" onclick="toggleSection('formReservarCita', this)">
                        <i class="fas fa-calendar-check mr-2"></i> Reservar cita
                    </a>
                    <a id="misCitasBtn" class="button bg-gray-200 hover:bg-gray-300 text-black py-2 px-4 rounded-2xl mx-2 lg:mx-0" onclick="recargarMisCitas(); toggleSection('listaMisCitas', this)">
                        <i class="fas fa-calendar-alt mr-2"></i> Mis citas
                    </a>



                    <button class="button bg-gray-200 hover:bg-gray-300 text-black py-2 px-4 rounded-2xl mx-2 lg:mx-0" onclick="toggleSection('examenes', this)">
                        <i class="fas fa-vial mr-2"></i> Exámenes
                    </button>

                    <button id="ajustesCuentaBtn" class="button bg-gray-200 hover:bg-gray-300 text-black py-2 px-4 rounded-2xl mx-2 lg:mx-0" onclick="toggleSection('ajustesCuenta', this)">
                        <i class="fas fa-user-cog mr-2"></i> Ajustes de cuenta
                    </button>

                    <button class="button bg-gray-200 hover:bg-gray-300 text-black py-2 px-4 rounded-2xl mx-2 lg:mx-0" onclick="toggleSection('encuestas', this)">
                        <i class="fas fa-comment-dots mr-2"></i> Encuestas y opiniones
                    </button>

                    <button id="verNoticiasBtn" class="button bg-gray-200 hover:bg-gray-300 text-black py-2 px-4 rounded-2xl mx-2 lg:mx-0" onclick="toggleSection('noticias', this)">
                        <i class="fas fa-newspaper mr-2"></i> Noticias
                    </button>
                </div>

                @include('vistas.cita.menu.reservar_cita')
                @include('vistas.cita.menu.noticias')
                @include('vistas.cita.menu.mis_citas')
                @include('vistas.cita.menu.ajustes_cuenta')

            </div>


        </div>



    </div>

    <script>
        // Esta función se ejecuta cuando se hace clic en "Mis citas"
        function recargarMisCitas() {
            const listaMisCitas = document.getElementById('listaMisCitas');

            // Primero ocultamos la lista de citas y la mostramos después de recargar
            listaMisCitas.style.display = 'none';

            // Esperamos un pequeño retraso antes de mostrarla nuevamente y recargar
            setTimeout(function() {
                // Aquí puedes ejecutar la lógica de recarga de las citas
                // Lo que hace es ocultar y luego mostrar la sección, como si fuera la primera vez
                listaMisCitas.style.display = 'block';

                // Aquí puedes forzar la recarga de los datos. Si tienes una función específica, la llamas:
                cargarCitas();  // Esto va a recargar tus citas (asegurándonos que no pierdas la lógica)

            }, 100);  // 100ms para asegurarse de que el DOM se actualice correctamente antes de mostrar
        }

    </script>


    <script>
        // Función para ajustar la altura del contenedor principal, descontando la altura del encabezado
        function setFullHeight() {
            const headerHeight = document.querySelector('header').offsetHeight; // Altura del header
            const extraHeight = 10; // Margen adicional para descontar un poco más
            const userProfile = document.getElementById('userProfile');

            // Calcula la altura restante para el contenedor
            const availableHeight = window.innerHeight - headerHeight - extraHeight;

            // Establecer el min-height en lugar de height para que el contenedor se expanda según el contenido
            userProfile.style.minHeight = `${availableHeight}px`;
        }

        // Llamar a la función cuando la página se cargue y cuando se cambie el tamaño de la ventana
        window.onload = setFullHeight;
        window.onresize = setFullHeight;
    </script>


    <script>
        function toggleSection(sectionId, button) {
            // Esconde todas las secciones
            const sections = ['formReservarCita', 'listaMisCitas', 'ajustesCuenta', 'examenes', 'encuestas', 'noticias'];
            sections.forEach(section => {
                const element = document.getElementById(section);
                if (element) {
                    element.style.display = 'none';
                }
            });

            // Muestra la sección seleccionada
            const section = document.getElementById(sectionId);
            if (section) {
                section.style.display = section.style.display === 'none' ? 'block' : 'none';
            }

            // Remover la clase 'active' de todos los botones
            const buttons = document.querySelectorAll('.button');
            buttons.forEach(function(btn) {
                btn.classList.remove('active');
            });

            // Agregar la clase 'active' al botón presionado
            button.classList.add('active');
        }
    </script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        // Mostrar la sección de 'Reservar cita' por defecto
        const defaultSection = document.getElementById('formReservarCita');
        if (defaultSection) {
            defaultSection.style.display = 'block';  // Asegúrate de que esta sección esté visible
        }
    });

</script>
    <style>
        .button {
            background-color: #f0f0f0;
            color: #000;
            padding: 10px 20px;
            border-radius: 50px;
            transition: transform 0.2s;
        }

        .button:hover {
            background-color: #e0e0e0;
        }

        .active {
            background-color: #d4d4d4; /* Color cuando el botón está activo */
        }
    </style>

@endsection
