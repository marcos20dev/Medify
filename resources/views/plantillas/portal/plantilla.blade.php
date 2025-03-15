<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Descripción breve de lo que trata tu sitio web, mejora SEO y UX.">
    <meta name="author" content="Tu Nombre o el de la Empresa">
    <title>@yield('title', 'Título Predeterminado')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/estilos/home.css') }}">
    <!-- Favicons -->
    <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('css/apps.css') }}">
    <link rel="shortcut icon" href="{{ asset('imagenes/logo-icon.png') }}" type="image/x-icon">

</head>

<body class="m-0 p-0 flex flex-col min-h-screen bg-gray-100">
    <!-- Encabezado -->
    <header class="w-full m-0 p-0">
        @include('header.portal.header')
    </header>

    <!-- Carrusel con un margen superior dinámico basado en la altura del encabezado -->

    <div class="mt-24 lg:mt-32 xl:mt-0">
        @yield('banner')
    </div>

    <!-- Contenido Principal -->
    <main class="container mx-auto px-4 flex-grow xl:mt-40">
        @yield('content')
    </main>

    <!-- Pie de página -->
    @include('footer.footer')

    <!-- Scripts -->
    <script src="{{ asset('js/main.js') }}"></script>

        
</body>

</html>
