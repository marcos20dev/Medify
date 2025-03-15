@extends('plantillas.portal.plantilla')

@section('title', 'Inicio')


@section('banner')
    <div
        class="relative bg-cover bg-center bg-no-repeat py-12 h-screen"style="background-image: url('{{ asset('img/home_fondo.jpg') }}');">

        <div class="relative pt-52 max-w-6xl mx-auto text-gray-800 px-4">

            <div>
                <div class="flex items-center space-x-4">
                    <span class="w-14 border-b border-gray-800 inline-flex"></span>
                    <p class="uppercase tracking-widest font-semibold">Gestión de Citas Médicas </p>
                </div>
                <div class="mt-3">
                    <p class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-bold">
                        Programa tu cita médica
                        <span class="text-blue-600" style="color: rgb(1, 170, 170);">fácil y rápidamente.</span>
                    </p>
                </div>
                <div class="mt-8">
                    <p class="max-w-xl text-lg ">
                        Accede a nuestro sistema moderno y seguro para agendar tus citas médicas
                        con los mejores especialistas. Todo desde la comodidad de tu hogar o en movimiento.
                    </p>
                </div>

                <div class="flex mt-14 space-x-10">
                    <!-- Botón 'Agenda ahora' con icono de calendario -->
                    <a href="{{ route('menu') }}"
                        class="text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out flex items-center justify-center"
                        style="background-color: rgb(1, 170, 170);"
                        onmouseover="this.style.backgroundColor='rgb(1, 150, 150)';"
                        onmouseout="this.style.backgroundColor='rgb(1, 170, 170)';">
                        <i class="fas fa-calendar-alt mr-2"></i> <!-- Icono de calendario -->
                        Agenda ahora
                        <i class="fas fa-arrow-right ml-2"></i> <!-- Icono de flecha a la derecha -->
                    </a>

                    <!-- Botón 'Ver especialidades' con icono de listado -->
                    <a href="{{ route('especialidades') }}"
                        class="bg-gray-800 hover:bg-gray-900 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out flex items-center justify-center">
                        <i class="fas fa-list-ul mr-2"></i> <!-- Icono de listado -->
                        Ver especialidades
                    </a>
                </div>
            </div>

        </div>

        <img src="{{ asset('img/banner.png') }}" alt="Screenshots del Software"
            class="absolute bottom-0 left-0 w-full h-auto">

    </div>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <div class="text-center my-12">
        <h2 class="text-2xl font-bold mb-6">Cómo agendar una cita:</h2>
        <div class="flex flex-wrap justify-center gap-10 px-20">
            <div class="p-6 w-72 text-center">
                <div class="flex justify-center mb-4">
                    <i class="fas fa-user-plus" style="color: rgb(1, 170, 170); font-size: 5rem;"></i>
                </div>
                <h3 class="font-semibold text-xl mb-2">Regístrate o ingresa</h3>
                <p>Inicia sesión en nuestra plataforma o regístrate para comenzar.</p>
                <a href="{{ route('login') }}" style="color: rgb(1, 170, 170);" class="hover:text-[rgb(1,150,150)] mt-4">Ir →</a>
            </div>
            <div class="p-6 w-72 text-center">
                <div class="flex justify-center mb-4">
                    <i class="fas fa-calendar-check" style="color: rgb(1, 170, 170); font-size: 5rem;"></i>
                </div>
                <h3 class="font-semibold text-xl mb-2">Elige tu especialista</h3>
                <p>Selecciona al mejor especialista según tus necesidades de salud.</p>
                <a href="{{ route('menu') }}" style="color: rgb(1, 170, 170);" class="hover:text-[rgb(1,150,150)] mt-4">Ir →</a>
            </div>
            <div class="p-6 w-72 text-center">
                <div class="flex justify-center mb-4">
                    <i class="fas fa-clock" style="color: rgb(1, 170, 170); font-size: 5rem;"></i>
                </div>
                <h3 class="font-semibold text-xl mb-2">Escoge un horario</h3>
                <p>Consulta la disponibilidad de horarios y selecciona el que mejor se ajuste a ti.</p>
                <a href="{{ route('menu') }}" style="color: rgb(1, 170, 170);" class="hover:text-[rgb(1,150,150)] mt-4">Ir →</a>
            </div>
            <div class="p-6 w-72 text-center">
                <div class="flex justify-center mb-4">
                    <i class="fas fa-notes-medical" style="color: rgb(1, 170, 170); font-size: 5rem;"></i>
                </div>
                <h3 class="font-semibold text-xl mb-2">Confirma tu cita</h3>
                <p>Confirma los detalles de tu cita y prepárate para recibir la mejor atención médica.</p>
                <a href="{{ route('menu') }}" style="color: rgb(1, 170, 170);" class="hover:text-[rgb(1,150,150)] mt-4">Ir
                    →</a>
            </div>
        </div>
    </div>


    <!-- Preguntas frecuentes sobre citas médicas -->

    <!-- Preguntas frecuentes sobre gestión de citas médicas -->
    <section class="max-w-5xl mx-auto py-16 text-slate-500 px-4" id="preguntas">
        <div class="flex flex-col items-center">
            <h1 class="text-4xl font-bold text-center">Preguntas frecuentes</h1>
            <p class="text-center mt-8 max-w-2xl">
                Verifica si tu inquietud se encuentra dentro de los siguientes
            </p>
        </div>

        <div class="mt-10">
            <ul class="space-y-6">
                <li class="bg-gray-200 shadow-lg rounded-lg p-5 md:p-10">
                    <details class="border-l-4 border-red-500 pl-4">
                        <summary class="font-semibold text-lg cursor-pointer">
                            ¿Cómo puedo agendar una cita?
                        </summary>
                        <p class="mt-4 text-gray-600">
                            Puedes agendar tu cita utilizando nuestra plataforma en línea. Registrandote con tus datos
                            selecciona el tipo deconsulta,
                            elige un especialista y el horario que más te convenga.
                        </p>
                    </details>
                </li>

                <li class="bg-gray-200 shadow-lg rounded-lg p-5 md:p-10">
                    <details class="border-l-4 border-red-500 pl-4">
                        <summary class="font-bold text-lg cursor-pointer">
                            ¿Qué debo hacer si necesito cancelar o reprogramar mi cita?
                        </summary>
                        <p class="mt-4 text-gray-600">
                            Puedes cancelar o reprogramar tu cita hasta 24 horas antes de la hora programada,
                            directamente desde tu cuenta en nuestro portal web.
                        </p>
                    </details>
                </li>
                <li class="bg-gray-200 shadow-lg rounded-lg p-5 md:p-10">
                    <details class="border-l-4 border-red-500 pl-4">
                        <summary class="font-bold text-lg cursor-pointer">
                            ¿Puedo elegir mi médico?
                        </summary>
                        <p class="mt-4 text-gray-600">
                            Sí, nuestra plataforma te permite elegir entre una variedad de especialistas según sus
                            perfiles profesionales y horarios disponibles.
                        </p>
                    </details>
                </li>
                <li class="bg-gray-200 shadow-lg rounded-lg p-5 md:p-10">
                    <details class="border-l-4 border-red-500 pl-4">
                        <summary class="font-bold text-lg cursor-pointer">
                            ¿Cuáles son los requisitos para agendar una cita?
                        </summary>
                        <p class="mt-4 text-gray-600">
                            Solo necesitas estar registrado en nuestra plataforma y tener una conexión a internet. No es
                            necesario instalar ningún software adicional.
                        </p>
                    </details>
                </li>
                <li class="bg-gray-200 shadow-lg rounded-lg p-5 md:p-10">
                    <details class="border-l-4 border-red-500 pl-4">
                        <summary class="font-bold text-lg cursor-pointer">
                            ¿Cómo puedo prepararme para mi cita?
                        </summary>
                        <p class="mt-4 text-gray-600">
                            Te recomendamos revisar las indicaciones específicas para cada tipo de consulta que se te
                            proporcionarán al momento de la confirmación de tu cita.
                        </p>
                    </details>
                </li>
            </ul>
        </div>
        <!-- Beneficios de agendar citas online -->
        <div class="mt-12 bg-gray-700 text-white p-8 rounded-lg shadow-lg">
            <h2 class="text-xl font-bold mb-4 text-white">Beneficios de agendar citas online</h2>
            <ul class="list-disc space-y-2 pl-5">
                <li>Ahorra tiempo y evita esperas</li>
                <li>Acceso a una amplia red de especialistas</li>
                <li>Gestiona tus citas desde cualquier lugar</li>
                <li>Evitar contagios por aglomeracion</li>
            </ul>
        </div>
    </section>

    </div>
@endsection
