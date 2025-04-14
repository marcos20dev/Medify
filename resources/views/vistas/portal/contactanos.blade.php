@extends('plantillas.portal.plantilla')

@section('title', 'Contactanos')

@section('content')

    <div class="container">

        <div class="text-center" style="margin-bottom: 50px;"> <!-- Reduje el margin-bottom -->
            <!-- Ajustar la altura y subir el mapa -->
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3950.15236317022!2d-78.9596833254413!3d-8.085939780846457!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x91ad1696b4264d3d%3A0x43610bb7b2c76dd!2sHospital%20De%20Laredo!5e0!3m2!1ses-419!2spe!4v1709047198199!5m2!1ses-419!2spe"
                    width="100%" height="500" style="border:0; min-height: 300px; margin-top: -20px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>

        <div class="mt-4 contact-icons-container">
            <div class="porto-icon text-center flex flex-col items-center">
                <i class="fas fa-map-marker-alt icon" style="font-size: 40px; color: rgba(0, 170, 169, 0.8);"></i>
                <p style="font-size: 16px; font-weight: bold;">Dirección</p>
                <p style="font-size: 13px;">Calle Orrego</p>
            </div>

            <div class="porto-icon text-center flex flex-col items-center">
                <i class="fas fa-mobile icon" style="font-size: 40px; color: rgba(0, 170, 169, 0.8);"></i>
                <p style="font-size: 16px; font-weight: bold;">Numero de contacto</p>
                <p style="font-size: 13px;">+51 923 931 363 / (044) 446044</p>
            </div>

            <div class="porto-icon text-center flex flex-col items-center">
                <i class="fas fa-envelope icon" style="font-size: 40px; color: rgba(0, 170, 169, 0.8);"></i>
                <p style="font-size: 16px; font-weight: bold;">E-mail</p>
                <p style="font-size: 13px;">andregarciar8@gmail.com</p>
            </div>

            <div class="porto-icon text-center flex flex-col items-center">
                <i class="far fa-calendar-alt icon" style="font-size: 40px; color: rgba(0, 170, 169, 0.8);"></i>
                <p style="font-size: 16px; font-weight: bold;">Horario de atención</p>
                <p style="font-size: 13px;">Lunes a Domingo 24/7</p>
            </div>
        </div>
    </div>

    <br><br>

@endsection

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        .contact-icons-container {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 40px;
            flex-wrap: wrap;
            margin-top: 20px; /* Aseguramos que los iconos estén más cerca del mapa */
        }
        .icon {
            transition: transform 0.3s ease-in-out;
        }
        .icon:hover {
            transform: scale(1.2); /* Cambia el tamaño del icono al pasar el mouse por encima */
        }
        .porto-icon {
            animation: slide-up 0.5s ease-out;
        }
        @keyframes slide-up {
            0% {
                opacity: 0;
                transform: translateY(50px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
