@extends('plantillas.portal.plantilla')

@section('title', 'Noticias')

@section('content')
    <div class="min-h-screen bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

            <!-- Filtro -->
            <div class="mb-6 border-b border-gray-300 pb-4">
                <div class="flex flex-col md:flex-row justify-between gap-3">
                    <h1 class="text-xl md:text-2xl font-semibold text-gray-800">Últimas Noticias</h1>
                    <form id="filtrarForm" action="{{ route('filtrarNoticias') }}" method="GET"
                          class="flex flex-col sm:flex-row items-stretch gap-3 w-full md:w-auto">
                        <input type="date" id="fecha" name="fecha"
                               class="w-full md:w-40 border border-gray-300 rounded-md text-sm py-2 px-3 focus:ring-blue-500 focus:border-blue-500">
                        <div class="flex gap-3">
                            <button type="submit"
                                    class="w-full md:w-auto bg-blue-600 text-white text-sm px-4 py-2 rounded-md hover:bg-blue-700 transition">
                                Filtrar
                            </button>
                            <a href="{{ route('noticias') }}"
                               class="w-full md:w-auto bg-gray-200 text-blue-600 text-sm px-4 py-2 rounded-md hover:bg-gray-300 transition text-center">
                                Limpiar
                            </a>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Noticias -->
            <div class="space-y-6">
                @foreach ($noticias as $noticia)
                    <a href="{{ route('mostrarNoticia', $noticia->id) }}" class="block group">
                        <article class="bg-white rounded-lg shadow-sm hover:shadow-md transition p-4 flex flex-col md:flex-row gap-4 items-start cursor-pointer">
                            <!-- Imagen -->
                            <div class="w-full md:w-48 h-48 md:h-32 overflow-hidden rounded-lg flex-shrink-0 relative">
                                <img src="data:image/jpeg;base64,{{ $noticia->foto }}" alt="{{ $noticia->titulo }}"
                                     class="w-full h-full object-cover transform transition group-hover:scale-105">
                                @if($noticia->created_at->diffInHours() < 24)
                                    <span class="absolute top-2 left-2 bg-red-500 text-white text-xs px-2 py-0.5 rounded-full font-semibold">
                                        URGENTE
                                    </span>
                                @endif
                            </div>

                            <!-- Contenido -->
                            <div class="flex-1 space-y-2">
                                <div class="text-xs text-blue-600 font-medium">
                                    {{ $noticia->categoria->nombre ?? 'General' }} •
                                    {{ $noticia->created_at->locale('es')->isoFormat('D MMM YYYY') }}
                                </div>
                                <h2 class="text-lg font-semibold text-gray-900 group-hover:text-blue-600 transition">
                                    {{ $noticia->titulo }}
                                </h2>
                                <p class="text-sm text-gray-600 line-clamp-3">
                                    {{ Str::limit(strip_tags($noticia->descripcion), 160) }}
                                </p>

                                @if(!empty($noticia->etiquetas))
                                    <div class="flex flex-wrap gap-1 mt-2">
                                        @foreach (explode(',', $noticia->etiquetas) as $tag)
                                            <span class="bg-blue-100 text-blue-600 text-xs px-2 py-0.5 rounded-full">
                                                {{ trim($tag) }}
                                            </span>
                                        @endforeach
                                    </div>
                                @endif

                                <!-- Autor -->
                                <div class="text-xs text-gray-500 flex flex-col sm:flex-row sm:items-center gap-2 pt-2 border-t border-gray-200 mt-3">
                                    <div class="flex items-center gap-2">
                                        <img class="h-5 w-5 rounded-full" src="https://via.placeholder.com/24" alt="Autor">
                                        <span>Redacción Hospital Distrital de Laredo</span>
                                    </div>
                                    <span class="hidden sm:block">·</span>
                                    <span>{{ $noticia->created_at->diffForHumans() }}</span>
                                </div>

                                <div>
                                    <span class="inline-block mt-2 text-blue-600 text-sm font-semibold hover:underline">
                                        Ver noticia completa →
                                    </span>
                                </div>
                            </div>
                        </article>
                    </a>
                @endforeach
            </div>

            <!-- Paginación -->
            <div class="mt-8 border-t border-gray-300 pt-6">
                {{ $noticias->links('pagination::simple-tailwind') }}
            </div>
        </div>
    </div>

    <style>
        .line-clamp-3 {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endsection
