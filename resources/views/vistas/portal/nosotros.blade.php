@extends('plantillas.portal.plantilla')

@section('title', 'Nosotros')

@section('content')
<h1 style="text-align: center; font-size: 36px; font-weight: bold; color: #333; margin-bottom: 10px; margin-top: 10px; font-family: 'Arial Black', sans-serif;">Nosotros</h1>

<div class="container mx-auto px-4 py-6">

    <div class="max-w-7xl mx-auto">
        <!-- Flex container for all content -->
        <div class="flex flex-wrap justify-center items-center">
            <!-- Image Section (Red) -->
            <div class="w-full md:w-1/2 px-4">
                <img src="{{ asset('recursos/nosotros3.jpeg') }}" alt="Our Team" class="w-full h-auto shadow-lg rounded-lg">
            </div>

            <div class="w-full md:w-1/2 px-4">
                <div class="space-y-4">
                    <div class="bg-gray-200 text-gray-800 rounded-lg shadow-lg p-6">
                        <h2 class="text-2xl font-bold mb-3">Quiénes Somos</h2>
                        <p class="text-lg leading-relaxed">
                            Somos un equipo comprometido con la excelencia en el cuidado de la salud, dedicados a ofrecer servicios médicos de primera calidad. Nuestra prioridad es garantizar el bienestar y la satisfacción de nuestros pacientes a través de un trato humano y profesional.
                        </p>
                    </div>
     
        
                <!-- Mission and Vision (Green) -->
                
                    <div class="bg-gray-700 text-white rounded-lg shadow-lg p-6">
                        <h2 class="text-xl font-bold text-white"><i class="fas fa-bullseye mr-2"></i>Misión</h2>
                        <p>Brindamos atención médica de excelencia, con profesionales especializados y respeto al paciente.</p>
                    </div>
                    <div class="bg-gray-700 text-white rounded-lg shadow-lg p-6">
                        <h2 class="text-xl font-bold text-white"><i class="fas fa-eye mr-2"></i>Visión</h2>
                        <p>Ser la red nacional de salud con pacientes encantados.</p>
                    </div>


                </div>
            
                <!-- Numerical Info (Blue) -->
                <div class="mt-4 grid grid-cols-3 gap-4">
                    <!-- Achievement 1 -->
                    <div class="bg-custom-color text-black rounded-lg shadow-lg p-6">
                        <h2 class="text-lg font-bold text-black"><i class="fas fa-trophy mr-2"></i> Pacientes Atendidos</h2>
                        <p>Más de 100,000 pacientes atendidos en el último año.</p>
                    </div>
                    
                    <!-- Achievement 2 -->
                    <div class="bg-custom-color text-black rounded-lg shadow-lg p-6">
                        <h2 class="text-lg font-bold text-black"><i class="fas fa-medal mr-2"></i> Calidad de Servicio</h2>
                        <p>95% de satisfacción en encuestas de servicio al cliente.</p>
                    </div>
                    
                    <!-- Achievement 3 -->
                    <div class="bg-custom-color text-black rounded-lg shadow-lg p-6">
                        <h2 class="text-lg font-bold text-black"><i class="fas fa-award mr-2"></i> Innovación en Salud</h2>
                        <p>Líderes en implementación de tecnología médica avanzada.</p>
                    </div>
                </div>
                


            </div>
            

        </div>
    </div>
</div>
<br>
<br>
@endsection
