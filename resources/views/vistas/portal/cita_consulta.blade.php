@extends('plantillas.portal.plantilla')

@section('title', 'Consulta Médica')

@section('content')
    <div class="max-w-7xl mx-auto mt-0">
        <div class="bg-white/95 backdrop-blur-sm rounded-3xl shadow-2xl overflow-hidden border border-white/20">
            <div class="flex flex-col lg:flex-row min-h-screen">
                <!-- Sección izquierda - Formulario -->
                <div class="w-full lg:w-1/2 p-8 lg:p-10 bg-gradient-to-br from-white to-gray-50">
                    <div class="flex items-center mb-8">
                        <div
                            class="w-12 h-12 rounded-xl bg-gradient-to-br from-blue-100 to-blue-50 flex items-center justify-center mr-4 shadow-inner">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="M9 5H7a2 2 0 00-2 2v12a2 2
                                         0 002 2h10a2 2 0 002-2V7a2 2
                                         0 00-2-2h-2M9 5a2 2 0 002
                                         2h2a2 2 0 002-2M9 5a2 2 0
                                         012-2h2a2 2 0 012 2"/>
                            </svg>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-900">
                            Consulta por DNI
                        </h2>
                    </div>


                    <form action="{{ route('buscar.cita') }}" method="POST" class="space-y-8">
                        @csrf
                        <div class="space-y-6">
                            <label for="dni" class="block text-sm font-medium text-gray-700 uppercase tracking-wider">
                                Número de DNI
                            </label>
                            <div class="flex items-center gap-3 w-full mt-6">
                                <div class="relative flex-grow">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400"
                                             fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M12 11c0 3.517-1.009 6.799-2.753 9.571m-3.44-2.04l.054-.09A13.916
                         13.916 0 008 11a4 4 0 118 0c0 1.017-.07 2.019-.203 3m-2.118
                         6.844A21.88 21.88 0 0015.171 17m3.839 1.132c.645-2.266.99-4.659.99-7.132
                         A8 8 0 008 4.07M3 15.364c.64-1.319 1-2.8 1-4.364
                         0-1.457.39-2.823 1.07-4"/>
                                        </svg>
                                    </div>
                                    <input
                                        type="text"
                                        name="dni"
                                        id="dni"
                                        maxlength="8"
                                        required
                                        class="w-full pl-10 pr-4 py-3 text-base border border-gray-300 rounded-lg
                   shadow-sm focus:border-cyan-600 focus:ring-cyan-500 focus:outline-none
                   transition placeholder-gray-400"
                                        placeholder="Ingrese número de DNI"
                                    >
                                </div>
                                <button type="submit"
                                        class="inline-flex items-center px-5 py-3 text-white font-medium rounded-lg
               bg-red-500 hover:bg-red-600 focus:outline-none focus:ring-4
               focus:ring-red-300 shadow transition">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                              d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817
                 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                    Buscar
                                </button>

                            </div>
                        </div>
                        </form>
                    @if(!session('citas') && !session('mensaje'))
                        <div class="mt-10 animate-fade-in">
                            <div class="bg-blue-50 p-6 rounded-xl border border-blue-100 shadow-sm">
                                <div class="flex items-start">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="h-6 w-6 mr-4 text-blue-500 flex-shrink-0" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 100 20
                             10 10 0 000-20z"/>
                                    </svg>
                                    <div class="flex-1">
                                        <h4 class="font-bold text-gray-900 text-lg">¿Primera vez buscando una cita?</h4>
                                        <p class="text-gray-700 mt-1">
                                            Para consultar una cita debes haberla agendado previamente. Si es tu primera vez, debes registrarte
                                            y luego iniciar sesión para poder agendar una.
                                        </p>

                                        <div class="mt-4 flex gap-3">
                                            <a href="{{ route('login') }}"
                                               class="inline-block px-4 py-2 bg-red-500 text-white text-sm font-semibold rounded hover:bg-red-600 transition">
                                                Agendar Cita
                                            </a>
                                            <a href="{{ route('registro') }}"
                                               class="inline-block px-4 py-2 bg-gray-200 text-gray-800 text-sm font-semibold rounded hover:bg-gray-300 transition">
                                                Registrarse
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    @if(session('citas'))
                        <div class="mt-10 animate-fade-in">
                            <div class="bg-white p-6 rounded-2xl border border-gray-100 shadow-sm">
                                <div class="flex items-center mb-6">
                                    <div class="bg-gradient-to-br from-indigo-100 to-indigo-50 p-3 rounded-xl mr-4 shadow-inner">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-indigo-600" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M8 7V3m8 4V3m-9 8h10m-12 8h14a2 2 0 002-2V7a2 2 0
                                 00-2-2H6a2 2 0 00-2 2v10a2 2 0
                                 002 2z"/>
                                        </svg>
                                    </div>
                                    <h3 class="text-2xl font-bold text-gray-900">Citas Pendientes</h3>
                                </div>
                                <div class="space-y-4">
                                    @foreach(session('citas') as $cita)
                                        <div class="p-4 bg-gray-50 border border-gray-100 rounded-xl">
                                            <p class="text-sm text-gray-500 uppercase tracking-wider">Paciente</p>
                                            <p class="text-base font-semibold text-gray-800">
                                                {{ $cita->user->Nombre }} {{ $cita->user->ApePaterno }} {{ $cita->user->ApeMaterno }}
                                            </p>

                                            <div class="flex items-center mt-4 space-x-2">
                                                <span class="h-3 w-3 rounded-full bg-green-500 inline-block"></span>
                                                <span class="text-sm font-medium text-green-700">Disponible</span>
                                            </div>

                                            <p class="text-sm text-gray-500 uppercase tracking-wider mt-4">Doctor</p>
                                            <p class="text-base font-semibold text-gray-800">
                                                Dr. {{ $cita->doctor->apellido }} {{ $cita->doctor->nombre }}
                                            </p>

                                            <p class="text-sm text-gray-500 uppercase tracking-wider mt-4">Fecha</p>
                                            <p class="text-base font-semibold text-gray-800">
                                                {{ \Carbon\Carbon::parse($cita->horario->fecha)->locale('es')->isoFormat('dddd, D [de] MMMM [del] YYYY') }}
                                            </p>
                                            <p class="text-sm text-gray-500 uppercase tracking-wider mt-4">Horario</p>

                                            <p class="text-lg font-mono text-gray-800">{{ $cita->horario->hora }}</p>

                                            <div class="mt-6 p-4 rounded-lg border" style="background-color: rgba(3, 194, 194, 0.1); border-color: rgb(3, 194, 194); color: rgb(3, 194, 194);">
                                                <p class="text-sm font-medium mb-2">
                                                    Inicia sesión para acceder a más detalles sobre tu cita y gestionar tus reservas.
                                                </p>
                                                <a href="{{ route('login') }}"
                                                   class="inline-block px-4 py-2 text-white text-sm font-semibold rounded transition"
                                                   style="background-color: rgb(3, 194, 194);">
                                                    Iniciar Sesión
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif


                    @if(session('mensaje') && !session('citas'))
                        <div class="mt-10 animate-fade-in">
                            <div class="bg-yellow-50 p-6 rounded-xl border border-yellow-100 shadow-sm">
                                <div class="flex items-start">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         class="h-6 w-6 mr-4 text-yellow-500 flex-shrink-0" fill="none"
                                         viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round"
                                              stroke-linejoin="round"
                                              stroke-width="2"
                                              d="M12 9v2m0 4h.01m-6.938
                                             4h13.856c1.54 0
                                             2.502-1.667
                                             1.732-3L13.732
                                             4c-.77-1.333-
                                             2.694-1.333-3.464
                                             0L3.34 16c-.77
                                             1.333.192 3
                                             1.732 3z"/>
                                    </svg>
                                    <div class="flex-1">
                                        <h4 class="font-bold text-gray-900 text-lg">No se encontraron citas</h4>
                                        <p class="text-gray-700 mt-1">
                                            {{ session('mensaje') }}
                                        </p>

                                        <hr class="my-4 border-yellow-200">

                                        <p class="text-sm text-gray-600">
                                            Para ver una cita, el paciente debe estar registrado en el sistema
                                            o la cita ya ha vencido y no se encuentra disponible.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif




                </div>

                <!-- Sección derecha - Lista de doctores (sin cambios) -->
                <div class="w-full lg:w-1/2 p-8 lg:p-10 bg-white">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between mb-10 gap-4">
                        <div class="flex items-center">
                            <div
                                class="w-12 h-12 rounded-xl bg-gradient-to-br from-indigo-100 to-indigo-50
                                       flex items-center justify-center mr-4 shadow-inner">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-indigo-600"
                                     fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 21V5a2 2 0
                                             00-2-2H7a2 2 0
                                             00-2
                                             2v16m14 0h2m-2 0h-5m-9
                                             0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1
                                             4h1m-5 10v-5a1 1 0 011-1h2a1 1
                                             0 011 1v5m-4 0h4"/>
                                </svg>
                            </div>
                            <h2 class="text-3xl font-bold text-gray-900">Especialistas Médicos</h2>
                        </div>
                        <div class="relative w-full sm:w-48">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" fill="none"
                                     viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M21 21l-6-6m2-5a7 7 0
                                             11-14 0 7 7 0 0114
                                             0z"/>
                                </svg>
                            </div>
                            <input type="text" id="buscador-doctores" placeholder="Buscar médico..."
                                   class="w-full pl-10 pr-4 py-2.5 text-sm rounded-full border
              border-gray-200 focus:outline-none focus:ring-2
              focus:ring-blue-500/30 focus:border-blue-500">

                        </div>
                    </div>


                    <div class="space-y-4">
                        @foreach($doctores as $doc)
                            <div id="resultado-busqueda" class="mt-6 text-sm text-gray-600 text-center"></div>

                            <div class="tarjeta-doctor group flex items-center p-5 rounded-xl bg-white border border-gray-100 hover:border-blue-100 hover:shadow-lg transition-all duration-300 cursor-pointer transform hover:-translate-y-1"
                                 data-busqueda="{{ strtolower($doc->nombre . ' ' . $doc->apellido . ' ' . $doc->especialidad) }}">
                                <div class="relative flex-shrink-0">
                                    <img class="h-16 w-16 rounded-full object-cover border-2 border-white shadow-md"
                                         src="https://ui-avatars.com/api/?name={{ urlencode($doc->nombre . ' ' . $doc->apellido) }}&background=random"
                                         alt="{{ $doc->nombre }} {{ $doc->apellido }}">
                                    <span class="absolute bottom-0 right-0 h-4 w-4 rounded-full border-2 border-white bg-green-400"></span>
                                </div>
                                <div class="ml-5 flex-1 min-w-0">
                                    <h3 class="text-lg font-bold text-gray-900 group-hover:text-blue-600">
                                        Dr. {{ $doc->nombre }} {{ $doc->apellido }}
                                    </h3>
                                    <p class="text-sm text-gray-600">{{ $doc->especialidad }}</p>
                                </div>
                                <button class="p-3 rounded-full bg-white text-gray-400 group-hover:text-blue-600 group-hover:bg-blue-50 shadow-sm hover:shadow-md transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5"
                                         viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd"
                                              d="M7.293 14.707a1 1 0 010-1.414L10.586
                         10 7.293 6.707a1 1 0 011.414-1.414l4
                         4a1 1 0 010 1.414l-4 4a1 1 0
                         01-1.414 0z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </button>
                            </div>
                        @endforeach

                    </div>


                </div>
            </div>
        </div>

        <br><br><br>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const input = document.getElementById('buscador-doctores');
            const tarjetas = document.querySelectorAll('.tarjeta-doctor');
            const resultado = document.getElementById('resultado-busqueda');

            function filtrarDoctores() {
                const filtro = input.value.toLowerCase();
                let encontrados = 0;

                tarjetas.forEach(tarjeta => {
                    const contenido = tarjeta.dataset.busqueda;
                    if (contenido.includes(filtro)) {
                        tarjeta.style.display = '';
                        encontrados++;
                    } else {
                        tarjeta.style.display = 'none';
                    }
                });

                if (filtro === '') {
                    resultado.textContent = '';
                } else if (encontrados === 0) {
                    resultado.textContent = 'No se encontró ningún doctor disponible en este momento. Consulte más tarde.';
                } else {
                    resultado.textContent = `${encontrados} resultado${encontrados === 1 ? '' : 's'} encontrado${encontrados === 1 ? '' : 's'}.`;
                }
            }

            input.addEventListener('input', filtrarDoctores);
        });
    </script>


    <!-- Estilos adicionales para animaciones -->
    <style>
        .animate-fade-in {
            animation: fadeIn 0.6s cubic-bezier(0.22, 1, 0.36, 1) forwards;
        }
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(15px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endsection
