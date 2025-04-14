@extends('plantillas.portal.plantilla')

@section('title', 'Nosotros')

@section('content')


        <div class="container mx-auto px-4 py-16 z-10">
            <div class="max-w-7xl mx-auto">
                <!-- Grid container mejorado -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-stretch">
                    <!-- Sección de imagen con efecto flotante -->
                    <div class="relative group h-full">
                        <div class="absolute inset-0 bg-gradient-to-br from-blue-100/20 to-indigo-100/20 rounded-3xl transform group-hover:-rotate-1 transition-transform duration-500"></div>
                        <img src="{{ asset('img/nosotros3.jpeg') }}" alt="Nuestro equipo"
                             class="w-full h-full object-cover rounded-3xl shadow-2xl transform group-hover:-translate-y-2 transition-transform duration-500">
                    </div>

                    <!-- Contenido principal con diseño mejorado -->
                    <div class="space-y-8 h-full">
                        <!-- Quiénes Somos con efecto vidrio -->
                        <div class="bg-white/80 backdrop-blur-sm rounded-3xl p-8 shadow-xl ring-1 ring-black/5">
                            <h2 class="text-3xl font-bold text-gray-900 mb-4 relative">
                                <span class="bg-clip-text text-transparent bg-gradient-to-r from-gray-800 to-gray-900">Quiénes Somos</span>
                                <div class="absolute bottom-0 left-0 w-24 h-1 bg-blue-600 rounded-full"></div>
                            </h2>
                            <p class="text-lg leading-relaxed text-gray-700">
                                Somos un equipo comprometido con la excelencia en el cuidado de la salud, dedicados a ofrecer servicios médicos de primera calidad. Nuestra prioridad es garantizar el bienestar y la satisfacción de nuestros pacientes a través de un trato humano y profesional.
                            </p>
                        </div>

                        <!-- Misión y Visión con diseño superpuesto -->
                        <div class="grid gap-6">
                            <div class="bg-gradient-to-br from-gray-700 to-gray-800 rounded-3xl p-8 shadow-2xl relative overflow-hidden">
                                <div class="absolute -right-8 -top-8 w-24 h-24 bg-blue-600/10 rounded-full blur-lg"></div>
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-blue-600/10 rounded-2xl flex items-center justify-center mr-4">
                                        <i class="fas fa-bullseye text-2xl text-blue-600"></i>
                                    </div>
                                    <h3 class="text-2xl font-bold text-white">Misión</h3>
                                </div>
                                <p class="text-gray-200 leading-relaxed">Brindamos atención médica de excelencia, con profesionales especializados y respeto al paciente.</p>
                            </div>

                            <div class="bg-gradient-to-br from-gray-700 to-gray-800 rounded-3xl p-8 shadow-2xl relative overflow-hidden">
                                <div class="absolute -left-8 -bottom-8 w-24 h-24 bg-indigo-600/10 rounded-full blur-lg"></div>
                                <div class="flex items-center mb-4">
                                    <div class="w-12 h-12 bg-indigo-600/10 rounded-2xl flex items-center justify-center mr-4">
                                        <i class="fas fa-eye text-2xl text-indigo-600"></i>
                                    </div>
                                    <h3 class="text-2xl font-bold text-white">Visión</h3>
                                </div>
                                <p class="text-gray-200 leading-relaxed">Ser la red nacional de salud con pacientes encantados.</p>
                            </div>
                        </div>

                        <!-- Logros con diseño de tarjetas interactivas -->
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            <!-- Logro 1 -->
                            <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300 group">
                                <div class="flex items-center mb-4">
                                    <div class="w-10 h-10 bg-blue-600/10 rounded-xl flex items-center justify-center mr-3">
                                        <i class="fas fa-trophy text-xl text-blue-600"></i>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900">Pacientes Atendidos</h3>
                                </div>
                                <div class="pl-1">
                                    <p class="text-3xl font-bold text-blue-600 mb-2">100K+</p>
                                    <p class="text-sm text-gray-600">En el último año</p>
                                </div>
                            </div>

                            <!-- Logro 2 -->
                            <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300 group">
                                <div class="flex items-center mb-4">
                                    <div class="w-10 h-10 bg-green-600/10 rounded-xl flex items-center justify-center mr-3">
                                        <i class="fas fa-medal text-xl text-green-600"></i>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900">Calidad de Servicio</h3>
                                </div>
                                <div class="pl-1">
                                    <p class="text-3xl font-bold text-green-600 mb-2">95%</p>
                                    <p class="text-sm text-gray-600">Satisfacción de clientes</p>
                                </div>
                            </div>

                            <!-- Logro 3 -->
                            <div class="bg-white/80 backdrop-blur-sm rounded-2xl p-6 shadow-lg hover:shadow-xl transition-shadow duration-300 group">
                                <div class="flex items-center mb-4">
                                    <div class="w-10 h-10 bg-purple-600/10 rounded-xl flex items-center justify-center mr-3">
                                        <i class="fas fa-award text-xl text-purple-600"></i>
                                    </div>
                                    <h3 class="text-xl font-bold text-gray-900">Innovación en Salud</h3>
                                </div>
                                <div class="pl-1">
                                    <p class="text-3xl font-bold text-purple-600 mb-2">#1</p>
                                    <p class="text-sm text-gray-600">En tecnología médica</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    <style>
        .group:hover .group-hover\:scale-105 {
            transform: scale(1.05);
        }

        .shadow-3xl {
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
        }
    </style>

@endsection
