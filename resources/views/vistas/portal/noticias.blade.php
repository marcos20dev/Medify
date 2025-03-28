@extends('plantillas.portal.plantilla')

@section('title', 'Noticias')

@section('content')

    <div class="max-w-6xl mx-auto mb-4"> <!-- Aumentar un poco más el ancho del contenedor -->


        <form id="filtrarForm" action="{{ route('filtrarNoticias') }}" method="GET" class="mb-4 flex items-center">
            <label for="fecha" class="mr-2">Filtrar por fecha:</label>
            <input type="date" id="fecha" name="fecha" class="border border-gray-300 rounded-md px-4 py-2 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 mr-2">
            <button type="submit" class="bg-teal-500 text-white px-4 py-2 rounded-md mr-2" style="background-color: rgb(0, 170, 169)">Filtrar</button>
            <a href="{{ route('noticias') }}" class="bg-gray-200 text-teal-500 px-4 py-2 rounded-md hover:bg-gray-300">Ver todo</a>
        </form>

        @if($noticias->isEmpty())
            <div class="flex items-center justify-center text-gray-500">
                <p>No hay noticias disponibles</p>
            </div>
        @else
            @foreach ($noticias as $noticia)
                <div class="flex items-start mb-4 px-2">
                    <div class="flex-1">
                        <h2 class="font-bold text-lg"><a href="{{ route('mostrarNoticia', $noticia->id) }}">{{ $noticia->titulo }}</a></h2>
                        <p class="text-gray-700">{{ Str::limit($noticia->descripcion, 340) }}</p>
                    </div>
                    <div class="flex-shrink-0 ml-4">
                        <!-- Utiliza la imagen en formato base64 -->
                        <img src="data:image/jpeg;base64,{{ $noticia->foto }}" alt="{{ $noticia->titulo }}" class="w-24 h-24 object-cover rounded">
                    </div>
                </div>
                <div class="flex items-start mb-4 px-2"> <!-- Nueva div para la fecha -->
                    <div class="flex-1"></div> <!-- Div para espacio -->
                    <div class="flex-shrink-0 ml-4"> <!-- Alineado con la imagen -->
                        <p class="text-sm text-gray-500">
                            @if($noticia->created_at->diffInDays() <= 3)
                                Hace {{ $noticia->created_at->locale('es')->diffForHumans() }}
                            @else
                                Publicado el {{ $noticia->created_at->locale('es')->isoFormat('D [de] MMMM [de] YYYY') }}
                            @endif
                        </p>
                    </div>
                </div>
                <hr>
            @endforeach
        @endif
    </div>

    <!-- Centrado de paginación -->
    <div class="flex justify-center mt-4">
        {{ $noticias->links() }}
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('filtrarForm');

            form.addEventListener('submit', function (event) {
                const fecha = document.getElementById('fecha').value;
                if (!fecha) {
                    event.preventDefault(); // Evita que el formulario se envíe
                    Swal.fire({
                        icon: 'error',
                        title: 'Por favor seleccione una fecha',
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            });
        });
    </script>
    <br>
@endsection
