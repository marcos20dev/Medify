<style>
    /* Estilos adicionales */
    #horas {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: flex-start;
        padding: 10px;
    }

    .button-hora {
        flex: 1 0 21%;
        text-align: center;
        padding: 8px 16px;
        background-color: #25c2c2;
        color: white;
        border: 2px solid #0da189;
        border-radius: 5px;
        cursor: pointer;
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.2);
    }

    .button-hora.selected {
        background-color: #28a745;
        border-color: #1e7e34;
    }

    .button-hora:hover {
        background-color: #28c9a6;
    }
</style>


<div id="formReservarCita" class="bg-white shadow-md rounded-lg p-6 flex-1 lg:ml-4 h-screen">
    <div class="flex flex-col lg:flex-row w-full h-full">

        <!-- Columna izquierda con formulario -->
        <div class="w-full lg:w-1/2 p-6 flex-grow">

            <form id="especialidadForm" action="javascript:void(0);">
                <!-- Especialidad -->
                <div class="mb-4">
                    <label for="especialidades" class="block text-gray-700 font-semibold mb-2">Especialidad:</label>
                    <select id="especialidades" name="especialidades" class="mt-1 p-2 w-full border rounded-md">
                        <option value="" disabled selected>Selecciona una especialidad</option>
                        @foreach ($especialidades as $especialidad)
                            <option value="{{ $especialidad }}">{{ $especialidad }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Doctores Disponibles -->
                <div class="mb-4">
                    <label for="doctores" class="block text-gray-700 font-semibold mb-2">Doctores Disponibles:</label>
                    <select id="doctores" name="doctores" class="mt-1 p-2 w-full border rounded-md" disabled>
                        <option value="">Selecciona un doctor</option>
                    </select>
                </div>

                <!-- Fecha -->
                <div class="mb-4">
                    <label for="fecha" class="block text-gray-700 font-semibold mb-2">Selecciona una fecha:</label>
                    <input type="date" id="fecha" name="fecha" class="mt-1 p-2 w-full border rounded-md" disabled />
                </div>

                <!-- Horas Disponibles -->
                <div class="mb-4">
                    <label for="horas" class="block text-gray-700 font-semibold mb-2">Horas Disponibles:</label>
                    <div id="horas" class="flex flex-wrap gap-2"></div>
                </div>

                <!-- Resumen de la cita -->
                <div id="resumenCita" class="hidden p-4 bg-gray-200 rounded-lg mb-4">
                    <p><strong>Paciente:</strong> <span id="nombrePaciente">{{ Auth::user()->Nombre }} {{ Auth::user()->ApePaterno }}</span></p>
                    <p><strong>Doctor:</strong> <span id="nombreDoctor"></span></p>
                    <p><strong>Fecha:</strong> <span id="fechaCita"></span></p>
                    <p><strong>Hora:</strong> <span id="horaCita"></span></p>
                </div>

                <!-- Botón de Confirmar Cita -->
                <div class="flex justify-center">
                    <button type="button" id="confirmarCitaBtn" class="hidden bg-green-500 text-white font-bold py-2 px-4 rounded hover:bg-green-700">Confirmar cita</button>
                </div>
            </form>
        </div>

        <!-- Línea Vertical de Separación -->
        <div class="hidden lg:block border-l-2 border-gray-300 h-full mx-4"></div>

        <!-- Columna derecha con contenido atractivo -->
        <div class="w-full lg:w-1/2 flex flex-col justify-center items-center text-center bg-blue-50 p-6 rounded-lg shadow-md flex-grow">
            <h3 class="text-xl font-semibold text-gray-800 mb-4">¡Bienvenido a nuestro sistema de citas!</h3>
            <p class="text-gray-600 mb-6">Es fácil y rápido reservar tu cita médica. Solo selecciona la especialidad, el doctor, el día y la hora que más te convenga.</p>
            <div class="text-gray-800 font-semibold mb-4">¡Tu salud es lo más importante para nosotros!</div>
            <div class="w-16 h-16 rounded-full bg-blue-200 flex items-center justify-center mb-4">
                <i class="fas fa-heart text-white text-3xl"></i>
            </div>
            <p class="text-sm text-gray-500">Reserva tu cita en solo unos pasos y asegura tu bienestar.</p>
        </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const especialidadesSelect = document.getElementById('especialidades');
        const doctoresSelect = document.getElementById('doctores');
        const fechaInput = document.getElementById('fecha');
        const horasDiv = document.getElementById('horas');
        const resumenCita = document.getElementById('resumenCita');
        const confirmarCitaBtn = document.getElementById('confirmarCitaBtn');
        let selectedHora = null;

        // Función para restablecer los valores del formulario
        function resetForm() {
            especialidadesSelect.value = "";  // Restablecer especialidad a vacío
            doctoresSelect.innerHTML = '<option value="">Selecciona un doctor</option>';
            doctoresSelect.disabled = true;  // Deshabilitar el select de doctores
            fechaInput.value = "";  // Limpiar la fecha
            fechaInput.disabled = true;  // Deshabilitar el input de fecha
            horasDiv.innerHTML = "";  // Limpiar las horas
            resumenCita.classList.add('hidden');  // Esconder resumen de cita
            confirmarCitaBtn.classList.add('hidden');  // Esconder botón de confirmar
            selectedHora = null;  // Limpiar la selección de hora
        }

        // Llamado cuando la página se recarga
        resetForm();  // Restablecer los valores al cargar la página

        // Llamado cuando elige especialidad
        especialidadesSelect.addEventListener('change', function () {
            const especialidad = this.value.trim();
            if (especialidad) {
                fetch(`/doctores?especialidad=${encodeURIComponent(especialidad)}`)
                    .then(response => response.json())
                    .then(data => {
                        doctoresSelect.innerHTML = '<option value="">Selecciona un doctor</option>';
                        data.forEach(doctor => {
                            const option = document.createElement('option');
                            option.value = doctor.dni;
                            option.textContent = `${doctor.nombre} ${doctor.apellido}`;
                            doctoresSelect.appendChild(option);
                        });
                        doctoresSelect.disabled = false;  // Habilitar el select de doctores
                        fechaInput.disabled = false;  // Habilitar el input de fecha
                        horasDiv.innerHTML = '';  // Limpiar horas
                        resumenCita.classList.add('hidden');  // Esconder resumen
                        confirmarCitaBtn.classList.add('hidden');  // Esconder botón de confirmar
                        fechaInput.value = "";  // Limpiar la fecha al cambiar la especialidad
                    })
                    .catch(error => {
                        console.error('Error al obtener los doctores:', error);
                        Swal.fire('Error', 'No se pudieron cargar los doctores. Inténtalo nuevamente.', 'error');
                    });
            } else {
                resetForm();  // Restablecer todo si no hay especialidad seleccionada
            }
        });

        // Cambio de doctor
        doctoresSelect.addEventListener('change', function () {
            if (this.value.trim()) {
                fechaInput.disabled = false;
                fechaInput.value = "";  // Limpiar la fecha cuando cambia el doctor
            } else {
                fechaInput.disabled = true;
                horasDiv.innerHTML = '';
            }
        });

        // Cambio de fecha
        fechaInput.addEventListener('change', function () {
            const doctorDni = doctoresSelect.value.trim();
            const fecha = this.value;

            if (doctorDni && fecha) {
                fetch(`/horarios?dni_doctor=${doctorDni}&fecha=${fecha}`)
                    .then(response => response.json())
                    .then(data => {
                        horasDiv.innerHTML = '';

                        if (data.length > 0) {
                            data.forEach(horario => {
                                const button = document.createElement('button');
                                button.classList.add('button-hora');
                                button.textContent = horario.hora;
                                button.value = horario.id;

                                button.addEventListener('click', function () {
                                    if (selectedHora) {
                                        selectedHora.classList.remove('selected');
                                    }
                                    this.classList.add('selected');
                                    selectedHora = this;

                                    // Muestra el resumen de la cita
                                    document.getElementById('nombreDoctor').textContent = doctoresSelect.options[doctoresSelect.selectedIndex].text;
                                    document.getElementById('fechaCita').textContent = fecha;
                                    document.getElementById('horaCita').textContent = this.textContent;

                                    resumenCita.classList.remove('hidden');
                                    confirmarCitaBtn.classList.remove('hidden');
                                });

                                horasDiv.appendChild(button);
                            });
                        } else {
                            horasDiv.innerHTML = '<p>No hay horarios disponibles</p>';
                        }
                    })
                    .catch(error => console.error('Error:', error));
            }
        });

        // Confirmar cita
        confirmarCitaBtn.addEventListener('click', async function () {
            if (selectedHora) {
                const confirmar = await Swal.fire({
                    title: 'Confirmar cita',
                    text: '¿Está seguro de que desea registrar esta cita?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, confirmar',
                    cancelButtonText: 'Cancelar'
                });

                if (confirmar.isConfirmed) {
                    const doctorId = doctoresSelect.value;
                    const horarioId = selectedHora.value;
                    const userId = {{ Auth::user()->id }}; // El ID del usuario autenticado

                    try {
                        const response = await fetch('{{ route('cita.store') }}', {
                            method: 'post',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                doctor_id: doctorId,
                                horario_id: horarioId,
                                user_id: userId
                            })
                        });

                        if (!response.ok) {
                            throw new Error('Error en la respuesta del servidor');
                        }

                        const data = await response.json();

                        if (response.ok) {
                            // Mostrar alerta de éxito
                            Swal.fire({
                                title: '¡Registro exitoso!',
                                text: 'La cita se ha registrado correctamente.',
                                icon: 'success',
                                confirmButtonText: 'Aceptar'
                            });

                            // Limpiar el formulario después de registrar la cita
                            resetForm();
                        } else {
                            Swal.fire('Error', 'No se pudo guardar la cita. Inténtelo de nuevo.', 'error');
                        }
                    } catch (error) {
                        Swal.fire('Error', 'Ocurrió un error al registrar la cita.', 'error');
                    }
                }
            } else {
                Swal.fire('Advertencia', 'Por favor seleccione una hora.', 'warning');
            }
        });
    });

</script>
