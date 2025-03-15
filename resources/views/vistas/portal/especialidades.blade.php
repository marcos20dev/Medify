@extends('plantillas.portal.plantilla')

@section('title', 'Especialidades')

@section('content')

    <h1
        style="text-align: center; font-size: 35px; font-weight: bold; color: #333; margin-bottom: 50px; margin-top: 10px; font-family: 'Arial Black', sans-serif;">
        Especialidades</h1>

    <div class="especialidades-container" style="max-width: 1200px; margin: 0 auto; padding: 0 20px;">
        @php
            $especialidades = [
                [
                    'title' => 'Ginecología',
                    'image' => 'recursos/ginecologia.png',
                    'description' =>
                        'La ginecología es la rama de la medicina que se especializa en la salud y enfermedades del sistema reproductor femenino, que incluye órganos como el útero, los ovarios, las trompas de Falopio y la vagina. Los profesionales de la ginecología, llamados ginecólogos, se centran en el diagnóstico, tratamiento y prevención de diversas condiciones y enfermedades ginecológicas, así como en el cuidado de la salud reproductiva de las mujeres. Esto abarca desde la adolescencia hasta la menopausia, cubriendo áreas como la obstetricia, planificación familiar, cuidado prenatal, entre otras.',
                ],
                [
                    'title' => 'Obstetricia',
                    'image' => 'recursos/obstetricia.png',
                    'description' =>
                        'La obstetricia es la rama de la medicina que se ocupa del embarazo, el parto y el período postparto. Los obstetras son especialistas en el cuidado de las mujeres embarazadas, brindando atención prenatal, asistiendo en el parto y proporcionando seguimiento médico después del nacimiento del bebé. El objetivo principal de la obstetricia es garantizar la salud y el bienestar tanto de la madre como del recién nacido durante todo el proceso de embarazo y parto.',
                ],
                [
                    'title' => 'Pediatría',
                    'image' => 'recursos/pediatria.png',
                    'description' =>
                        'La pediatría es la rama de la medicina que se centra en la atención médica de los niños, desde el nacimiento hasta la adolescencia. Los pediatras son médicos especializados en el cuidado de la salud infantil, abordando aspectos como el desarrollo físico, emocional y social de los niños. Su objetivo es prevenir, diagnosticar y tratar enfermedades y afecciones específicas de la infancia, además de brindar orientación a los padres sobre la salud y el bienestar de sus hijos.',
                ],
                [
                    'title' => 'Enfermería',
                    'image' => 'recursos/enfermeria.png',
                    'description' =>
                        'La enfermería es esencial en el cuidado de la salud, ofreciendo atención integral a individuos, familias y comunidades. Enfermeros y enfermeras realizan tareas vitales como administrar tratamientos, realizar procedimientos médicos y brindar apoyo emocional a pacientes. Trabajan en colaboración con otros profesionales para prevenir enfermedades y promover la recuperación. La enfermería abarca diversas especialidades y entornos, desde hospitales y clínicas hasta atención domiciliaria y salud pública.',
                ],
                [
                    'title' => 'Psicología',
                    'image' => 'recursos/psicologia.png',
                    'description' =>
                        'La psicología estudia la mente y el comportamiento humano. Los psicólogos exploran cómo piensan, sienten y se comportan las personas, investigando procesos mentales y emocionales. Utilizan este conocimiento para ayudar a superar problemas emocionales, mejorar relaciones, manejar el estrés y desarrollar habilidades para enfrentar desafíos. La psicología abarca áreas como la clínica, educativa, organizacional e investigación, contribuyendo al bienestar emocional y mental.',
                ],
                [
                    'title' => 'Nutrición',
                    'image' => 'recursos/nutricion.png',
                    'description' =>
                        'La nutrición se enfoca en cómo los alimentos influyen en la salud y el bienestar. Nutricionistas y dietistas asesoran sobre hábitos alimenticios saludables y diseñan planes nutricionales personalizados. Su meta es promover una alimentación equilibrada que provea los nutrientes necesarios para el cuerpo. Además de tratar temas como pérdida de peso y mantener un peso saludable, la nutrición también es clave en la prevención y manejo de enfermedades relacionadas con la alimentación.',
                ],
                [
                    'title' => 'Odontología',
                    'image' => 'recursos/diente.png',
                    'description' =>
                        'La odontología es la rama de la salud dedicada al diagnóstico, prevención y tratamiento de problemas bucales y maxilofaciales. Los dentistas son expertos en cuidar dientes, encías y estructuras relacionadas, ofreciendo desde limpiezas dentales hasta tratamientos restaurativos como empastes y extracciones. También se ocupan de la estética dental, mejorando la apariencia y función de la dentadura mediante procedimientos como blanqueamientos y ortodoncia..',
                ],
            ];
        @endphp


        @foreach ($especialidades as $index => $especialidad)
            <div class="cuadro-blanco">
                <div class="front">
                    <img src="{{ asset($especialidad['image']) }}" alt="{{ $especialidad['title'] }}" class="especialidad-img">
                    <h2 class="text-center">{{ $especialidad['title'] }}</h2>

                </div>
                <div class="back">
                    <p class="descripcion">{{ $especialidad['description'] }}</p>
                </div>
            </div>
        @endforeach
    </div>




    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const botones = document.querySelectorAll('.ver-mas-btn');

            botones.forEach(boton => {
                boton.addEventListener('mouseenter', function() {
                    const index = this.getAttribute('data-toggle');
                    const backs = document.querySelectorAll('.back');
                    backs.forEach(back => {
                        back.classList.remove('opacity-100');
                        back.classList.add('opacity-0');
                    });
                    const back = document.querySelector(#back - $ {
                        index
                    });
                    if (back) {
                        back.classList.toggle('opacity-0');
                        back.classList.toggle('opacity-100');
                    }
                });

                boton.addEventListener('mouseleave', function() {
                    const index = this.getAttribute('data-toggle');
                    const back = document.querySelector(#back - $ {
                        index
                    });
                    if (back) {
                        back.classList.remove('opacity-100');
                        back.classList.add('opacity-0');
                    }
                });
            });
        });
    </script>

@endsection
