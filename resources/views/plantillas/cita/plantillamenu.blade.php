<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/flatpickr.min.css">
    <link rel="stylesheet" href="{{ asset('css/estilos/registro.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha384-Ahcb4YdAxWXH+kBd6eXo5H/pjp0o+yQ1J9jV27lXyEv2ql6MyO1g1fVY/PCa8cl1" crossorigin="anonymous">
        <link rel="shortcut icon" href="{{ asset('imagenes/logo-icon.png') }}" type="image/x-icon">

</head>

<body class="bg-gray-100">

    @include('header.cita.menuheader')



    @yield('cita')


</body>

</html>
