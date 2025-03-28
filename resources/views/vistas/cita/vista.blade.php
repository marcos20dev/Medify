@extends('plantillas.cita.citaplantilla')

@section('title', 'Agendar Citas')

@section('content')
    <div class="flex justify-center min-h-screen bg-gray-100">
        <div class="w-full max-w-6xl px-6 py-12 flex justify-between items-center">
            <div class="w-1/2">
                <a href="{{ route('login') }}" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-4 px-8 rounded-lg shadow-lg mb-8 transition duration-300 ease-in-out transform hover:scale-105 block">Iniciar sesión</a>
                <div class="text-gray-800">
                    <h2 class="text-3xl font-semibold mb-8">Recomendaciones antes de acudir a la cita:</h2>
                    <ul class="text-lg mb-8">
                        <li class="mb-4 flex items-center justify-start">
                            <span class="text-green-600 mr-2">&#10004;</span>
                            Llegar con al menos 20 minutos de anticipación para evitar retrasos.
                        </li>
                        <li class="mb-4 flex items-center justify-start">
                            <span class="text-green-600 mr-2">&#10004;</span>
                            Confirmar la cita previamente para asegurar disponibilidad.
                        </li>
                        <li class="mb-4 flex items-center justify-start">
                            <span class="text-green-600 mr-2">&#10004;</span>
                            Traer consigo la documentación requerida según las indicaciones.
                        </li>
                        <li class="mb-4 flex items-center justify-start">
                            <span class="text-green-600 mr-2">&#10004;</span>
                            Respetar el horario establecido para evitar demoras en otras citas.
                        </li>
                        <li class="flex items-center justify-start">
                            <span class="text-green-600 mr-2">&#10004;</span>
                            Notificar con antelación en caso de cancelación o necesidad de reprogramación.
                        </li>
                    </ul>
                    <h2 class="text-3xl font-semibold mb-8">Otras recomendaciones importantes:</h2>
                    <ul class="text-lg">
                        <li class="mb-4 flex items-center justify-start">
                            <span class="text-green-600 mr-2">&#10004;</span>
                            Mantener una dieta equilibrada y una hidratación adecuada antes de la cita.
                        </li>
                        <li class="mb-4 flex items-center justify-start">
                            <span class="text-green-600 mr-2">&#10004;</span>
                            Descansar lo suficiente la noche anterior para estar alerta durante la consulta.
                        </li>
                        <li class="mb-4 flex items-center justify-start">
                            <span class="text-green-600 mr-2">&#10004;</span>
                            Preparar preguntas o inquietudes para discutir con el profesional de salud.
                        </li>
                        <li class="mb-4 flex items-center justify-start">
                            <span class="text-green-600 mr-2">&#10004;</span>
                            Llevar un registro de síntomas o cambios en la salud desde la última cita.
                        </li>
                        <li class="flex items-center justify-start">
                            <span class="text-green-600 mr-2">&#10004;</span>
                            Mantener una actitud positiva y abierta durante la consulta.
                        </li>
                    </ul>
                </div>
            </div>
            <div class="w-1/2">
                <!-- Contenido adicional en el lado derecho -->
                <div class="bg-white shadow-lg rounded-lg p-6">
                    <h2 class="text-xl font-semibold mb-4">Noticias recientes</h2>
                    <div class="grid grid-cols-1 gap-4">
                        <!-- Aquí puedes agregar contenido adicional como noticias, enlaces útiles, anuncios, etc. -->
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
