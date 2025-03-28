@extends('plantillas.cita.plantillamenu')

@section('title', 'Registrate')

@section('cita')

    <script>
        // Función para ajustar la altura del contenedor principal, descontando la altura del encabezado
        function setFullHeight() {
            const headerHeight = document.querySelector('header').offsetHeight; // Altura del header
            const extraHeight = 10; // Margen adicional para descontar un poco más
            const userProfile = document.getElementById('registroForm');

            // Calcula la altura restante para el contenedor
            const availableHeight = window.innerHeight - headerHeight - extraHeight;

            // Establecer el min-height en lugar de height para que el contenedor se expanda según el contenido
            userProfile.style.minHeight = `${availableHeight}px`;
        }

        // Llamar a la función cuando la página se cargue y cuando se cambie el tamaño de la ventana
        window.onload = setFullHeight;
        window.onresize = setFullHeight;
    </script>

    <script>
        function ajustarFormulario() {
            const header = document.querySelector('header'); // Busca el header
            const form = document.getElementById('registroForm');

            if (window.innerWidth < 768) { // Solo en celulares
                const headerHeight = header.offsetHeight;
                form.style.marginTop = `${headerHeight + 10}px`; // Agrega un pequeño espacio extra
            } else {E
                form.style.marginTop = '0px'; // En PC, no cambia nada
            }
        }

        window.onload = ajustarFormulario;
        window.onresize = ajustarFormulario;
    </script>


    <form id="registroForm" action="{{ route('registro') }}" method="POST"
          class="flex items-center justify-center w-full h-screen bg-white p-10 rounded shadow-md ">




        @csrf

        <div class="grid grid-cols-1 md:grid-cols-2 w-11/12 mx-auto h-screen items-center bg-white p-">
            <!-- Sección de Bienvenida -->
            <div class="p-8 hidden md:flex flex-col justify-center items-start text-left">
                <h1 class="text-7xl font-extrabold text-gray-900">Bienvenido</h1>
                <p class="mt-6 text-xl text-gray-700 max-w-lg text-justify leading-relaxed">
                    Regístrate de forma segura y accede a todos los servicios del hospital.
                    Tus datos serán protegidos y almacenados correctamente.
                    Usa tu <strong class="text-blue-600">DNI</strong> y <strong class="text-blue-600">contraseña</strong>
                    para iniciar sesión y gestionar tu información fácilmente.
                </p>
            </div>


            <div class="w-full">
                <h2 class="text-2xl font-semibold mb-2">Registro</h2>
                <!-- Select Tipo de Documento -->
                <div class="mb-4 md:flex md:flex-col">
                    <select name="TipoDoc" id="TipoDoc" class="mt-1 p-2 w-full border rounded-md"
                            onchange="toggleNumdocField()" required>
                        <option value="" disabled selected>Seleccione Tipo de Documento</option>
                        <option value="DNI">DNI</option>
                        <option value="CARNET_EXTRANJERIA">Carnet de Extranjería</option>
                        <option value="PASAPORTE">Pasaporte</option>
                        <option value="DOCUMENTO_EXTRANJERO">Documento de Identidad Extranjero</option>
                        <option value="PEP">PEP</option>
                    </select>
                </div>

                <!-- Input Número de Documento -->

                <form id="dniForm" action="{{ route('api.consulta.dni') }}" method="POST"
                      class="flex flex-col items-center justify-center p-6">
                    @csrf

                    <div class="mb-4 md:flex md:items-center">
                        <input type="text" name="Numdoc" id="Numdoc" placeholder="Número de Documento"
                               class="mt-1 p-2 w-full border rounded-md" required>
                        <button type="button" onclick="buscarDNI()"
                                class="ml-2 bg-custom-color hover:bg-custom-color text-white font-bold py-2 px-4 rounded">Buscar</button>
                    </div>

                    @if(session('error'))
                        <div class="text-red-500 bg-red-100 p-3 rounded">
                            {{ session('error') }}
                        </div>
                    @endif

                    <!-- Input Nombre -->
                    <div class="mb-4 md:flex md:flex-col">
                        <input type="text" name="Nombre" id="Nombre" placeholder="Nombre"
                               class="mt-1 p-2 w-full border rounded-md" required readonly>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-0">
                        <!-- Input Apellido Paterno -->
                        <div class="mb-4 md:flex md:flex-col">
                            <input type="text" name="ApePaterno" id="ApePaterno" placeholder="Apellido Paterno"
                                   class="mt-1 p-2 w-full border rounded-md" required readonly>
                        </div>

                        <!-- Input Apellido Materno -->
                        <div class="mb-4 md:flex md:flex-col">
                            <input type="text" name="ApeMaterno" id="ApeMaterno" placeholder="Apellido Materno"
                                   class="mt-1 p-2 w-full border rounded-md" required readonly>
                        </div>
                    </div>

                </form>

                <!-- Input Teléfono -->
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <!-- Input Teléfono -->
                    <div class="w-15/30 pr-2 relative">
                        <input type="text" name="Telefono" id="Telefono" placeholder="Teléfono"
                               class="mt-1 p-2 w-full border rounded-md" oninput="validatePhone()" required>
                    </div>

                    <!-- Input Fecha de Nacimiento -->
                    <div class="form-group form-focus focused w-full relative">
                        <input type="text" name="Fechanac" id="dtm_fecha" required placeholder="Fecha de Nacimiento"
                               class="mt-1 p-2 w-full border rounded-md">

                    </div>

                </div>

                <!-- Select Género -->
                <div class="mb-2">
                    <select name="Genero" id="Genero" class="mt-1 p-2 w-full border rounded-md" required>
                        <option value="" disabled selected>Género</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                        <option value="PrefieroNoDecirlo">Prefiero no decirlo</option>
                    </select>
                </div>

                <!-- Select Región y Provincia -->
                <div class="grid grid-cols-2 gap-4 mb-4">
                    <!-- Select Región -->
                    <div>
                        <select name="Region" id="Region" class="mt-1 p-2 w-full border rounded-md">
                            <option value="" disabled selected>Región</option>

                            @foreach ($regiones as $id => $nombre)
                                <option value="{{ $id }}">{{ $nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <!-- Select Provincia -->
                    <div>
                        <select name="Provincia" id="Provincia" class="mt-1 p-2 w-full border rounded-md">
                            <option value="" disabled selected>Provincia</option>
                        </select>
                    </div>
                </div>

                <!-- Select Distrito -->
                <div class="grid grid-cols-2 gap-4 mb-4">

                    <!-- Select Distrito -->
                    <div>
                        <select name="Distrito" id="Distrito" class="mt-1 p-2 w-full border rounded-md">
                            <option value="" disabled selected>Distrito</option>
                        </select>
                    </div>
                    <!-- Input Dirección -->
                    <div>
                        <input type="text" name="Direccion" id="Direccion" placeholder="Dirección"
                               class="mt-1 p-2 w-full border rounded-md" required>
                    </div>
                </div>

                <!-- Input Correo Electrónico -->
                <div class="mb-4">
                    <input type="email" name="Gmail" id="Gmail" placeholder="Correo Electrónico (opcional)"
                           class="mt-1 p-2 w-full border rounded-md">
                </div>

                <!-- Input Contraseña -->
                <div class="mb-4 relative">
                    <input id="password" type="password" name="password" placeholder="Contraseña"
                           class="mt-1 p-2 w-full border rounded-md">
                    <button id="toggle-password-button" type="button"
                            class="absolute inset-y-0 right-0 px-3 text-gray-400 focus:outline-none"
                            onclick="togglePassword()">
                        <img id="password-icon" src="{{ asset('img/ps.png') }}" alt="Mostrar/Ocultar contraseña"
                             class="h-6 w-6">
                    </button>
                </div>

                <!-- Botón Registrar -->
                <button type="submit" id="submitButton"
                        class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 focus:outline-none focus:bg-red-600">
                    Registrar
                </button>
                <!-- Enlace para Iniciar Sesión -->
                <p class="mt-4 text-sm">¿Ya tienes una cuenta? <a href="{{ route('login') }}"
                                                                  class="text-blue-500 hover:text-blue-600">Inicia sesión</a></p>
            </div>

        </div>
    </form>





    <script src="https://cdn.jsdelivr.net/npm/flatpickr@4.6.6/dist/flatpickr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        function buscarDNI() {
            var dni = document.getElementById('Numdoc').value;
            if (dni) {
                fetch('{{ route('api.consulta.dni') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    },
                    body: JSON.stringify({
                        dni: dni
                    })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.nombres) { // Asegúrate de que estás usando los nombres de campos correctos
                            document.getElementById('Nombre').value = data.nombres; // Cambiado de nombre a nombres
                            document.getElementById('ApePaterno').value = data.apellidoPaterno;
                            document.getElementById('ApeMaterno').value = data.apellidoMaterno;
                        } else {
                            alert('No se encontraron datos para el DNI ingresado.');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Hubo un error al buscar el DNI: ' + error.message);
                    });
            } else {
                alert('Por favor, ingrese un DNI');
            }
        }
    </script>




    <script>
        document.getElementById('registroForm').addEventListener('submit', function(event) {
            event.preventDefault(); // Evita el envío normal del formulario

            let formData = new FormData(this);

            fetch(this.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: '¡Registro exitoso!',
                            text: data.message,
                            confirmButtonText: 'Aceptar'
                        }).then(() => {
                            window.location.href = "{{ route('login') }}"; // Redirigir después de aceptar
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message,
                            confirmButtonText: 'Aceptar'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    </script>




    </script>
    <script>
        function toggleNumdocField() {
            var tipoDocSelect = document.getElementById("TipoDoc");
            var numdocInput = document.getElementById("Numdoc");

            // Si se selecciona un tipo de documento, habilita la edición del campo de entrada del número de documento
            if (tipoDocSelect.value !== "") {
                numdocInput.removeAttribute("readonly");
                numdocInput.classList.remove("readonly"); // Remueve la clase que aplica el estilo para modo de solo lectura
            } else {
                // De lo contrario, deshabilita la edición del campo de entrada del número de documento
                numdocInput.setAttribute("readonly", "readonly");
                numdocInput.classList.add("readonly"); // Agrega la clase que aplica el estilo para modo de solo lectura
            }
        }
    </script>

    <script>
        document.addEventListener('DOMContentLoaded',
            function() {

                flatpickr("#dtm_fecha", {

                    enableTime: false,
                    dateFormat: "d-m-y",
                });
            });
    </script>


    <script>
        function validatePhone() {
            var telefonoInput = document.getElementById("Telefono");
            var telefonoValue = telefonoInput.value.trim();

            // Eliminar caracteres no numéricos del valor del teléfono
            var cleanedPhoneNumber = telefonoValue.replace(/\D/g, '');

            // Verificar si el número de teléfono comienza con "9" y tiene 9 dígitos en total
            if (/^9\d{8}$/.test(cleanedPhoneNumber)) {
                // Si cumple con las condiciones, el número de teléfono es válido
                telefonoInput.setCustomValidity('');
            } else {
                // Si no cumple con las condiciones, mostrar un mensaje de error
                telefonoInput.setCustomValidity('El número de teléfono debe comenzar con 9 y tener 9 dígitos en total.');
            }
        }
    </script>

    <script>
        function validateNumdoc() {
            const numdocInput = document.getElementById('Numdoc');
            const tooltip = document.getElementById('numdocTooltip');

            if (!/^\d^$/.test(numdocInput.value)) {
                tooltip.classList.remove('hidden');
                numdocInput.setCustomValidity('Por favor, ingresa solo números en este campo.');
            } else {
                tooltip.classList.add('hidden');
                numdocInput.setCustomValidity('');
            }
        }
    </script>

    <script>
        function togglePassword() {
            const password = document.getElementById("password");
            const button = document.getElementById("toggle-password-button");
            const icon = document.getElementById("password-icon");

            if (password.type === "password") {
                password.type = "text";
                icon.src = "{{ asset('img/ps-tachado.png') }}"; // Cambia la imagen a una contraseña tachada
            } else {
                password.type = "password";
                icon.src = "{{ asset('img/ps.png') }}"; // Cambia la imagen de nuevo a la contraseña normal
            }
        }
    </script>
    <!-- Script para validar el número de teléfono -->
    <script>
        function validatePhone() {
            var telefonoInput = document.getElementById("Telefono");
            var telefonoValue = telefonoInput.value.trim();

            // Eliminar caracteres no numéricos del valor del teléfono
            var cleanedPhoneNumber = telefonoValue.replace(/\D/g, '');

            // Verificar si el número de teléfono comienza con "9" y tiene 9 dígitos en total
            if (/^9\d{8}$/.test(cleanedPhoneNumber)) {
                // Si cumple con las condiciones, el número de teléfono es válido
                telefonoInput.setCustomValidity('');
            } else {
                // Si no cumple con las condiciones, mostrar un mensaje de error
                telefonoInput.setCustomValidity('El número de teléfono debe comenzar con 9 y tener 9 dígitos en total.');
            }
        }
    </script>


    <script>
        document.getElementById('Region').addEventListener('change', function() {
            var regionId = this.value;
            cargarProvincias(regionId);
            var selectDistrito = document.getElementById('Distrito');
            selectDistrito.innerHTML = '<option value="" disabled selected>Distrito</option>';

        });

        function cargarProvincias(regionId) {
            var selectProvincia = document.getElementById('Provincia');
            selectProvincia.innerHTML =
                '<option value="" disabled selected>Provincia</option>'; // Limpiar el select de provincias antes de cargar nuevas opciones

            // Realizar solicitud AJAX para obtener las provincias correspondientes a la región seleccionada
            fetch("{{ route('obtener-provincias') }}?region_id=" + regionId)
                .then(response => response.json())
                .then(data => {
                    // Iterar sobre las provincias recibidas y agregarlas al select de provincias
                    for (const [id, provincia] of Object.entries(data)) {
                        var option = document.createElement("option");
                        option.value = id;
                        option.text = provincia;
                        selectProvincia.appendChild(option);
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script>

    <script>
        document.getElementById('Provincia').addEventListener('change', function() {
            var provinciaId = this.value;
            cargarDistritos(provinciaId);
        });

        function cargarDistritos(provinciaId) {
            var selectDistrito = document.getElementById('Distrito');
            selectDistrito.innerHTML =
                '<option value="" disabled selected>Distrito</option>'; // Limpiar el select de distritos antes de cargar nuevas opciones

            // Realizar solicitud AJAX para obtener los distritos correspondientes a la provincia seleccionada
            fetch("{{ route('obtener-distritos') }}?provincia_id=" + provinciaId)
                .then(response => response.json())
                .then(data => {
                    // Iterar sobre los distritos recibidos y agregarlos al select de distritos
                    for (const [id, distrito] of Object.entries(data)) {
                        var option = document.createElement("option");
                        option.value = id;
                        option.text = distrito;
                        selectDistrito.appendChild(option);
                    }
                })
                .catch(error => console.error('Error:', error));
        }
    </script>

@endsection
