@extends('plantillas.portal.plantilla')

@section('title', 'Noticia '. $noticia->titulo)

@section('content')

    <div class="max-w-5xl mx-auto py-8 px-6">
        <div class="mb-8">
            <a href="{{ route('noticias') }}" class="inline-block bg-gray-200 hover:bg-gray-300 rounded-full p-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-600 hover:text-gray-800" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
            </a>
        </div>
        <h3 class="text-2xl font-bold mb-4">{{ $noticia->titulo }}</h3>
        
        <div>
            <img src="data:image/jpeg;base64,{{ $noticia->foto }}" alt="{{ $noticia->titulo }}" class="w-full object-cover rounded mb-4">
        </div>

        <div class="text-gray-700">
            {!! $noticia->descripcion !!} <!-- Mostrar el contenido HTML generado por CKEditor -->
        </div>
    </div>

@endsection
