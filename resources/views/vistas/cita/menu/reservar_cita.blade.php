<style>
    /* Mantenemos toda la estructura original, solo cambiamos colores */
    #horas {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        justify-content: flex-start;
        padding: 10px;
    }

    .button-hora {
        flex: 1 0 21%; /* Mantenemos el mismo tamaño y flexibilidad */
        text-align: center;
        padding: 8px 16px;
        background-color: #EFF6FF; /* Azul muy claro (similar a bg-blue-50) */
        color: #1E40AF; /* Azul oscuro para texto */
        border: 2px solid #BFDBFE; /* Borde azul claro */
        border-radius: 5px;
        cursor: pointer;
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.1); /* Sombra más suave */
        transition: background-color 0.2s ease; /* Transición solo para color */
    }

    .button-hora.selected {
        background-color: #3B82F6; /* Azul vibrante para selección */
        color: white;
        border-color: #2563EB;
    }

    .button-hora:hover {
        background-color: #DBEAFE; /* Azul claro al pasar mouse */
    }

    .button-hora:disabled {
        background-color: #F3F4F6;
        color: #9CA3AF;
        border-color: #E5E7EB;
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

                <div class="mb-6">
                    <label for="horas" class="block text-gray-700 font-semibold mb-3 text-sm uppercase tracking-wider">Horas Disponibles</label>
                    <div id="horas" class="flex flex-wrap gap-3">
                        <!-- Ejemplo de botones -->
                        <button type="button" class="button-hora">08:00 AM</button>
                        <button type="button" class="button-hora">09:00 AM</button>
                        <button type="button" class="button-hora selected">10:00 AM</button>
                        <button type="button" class="button-hora">11:00 AM</button>
                        <button type="button" class="button-hora" disabled>12:00 PM</button>
                    </div>
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
            <div class="w-20 h-20 rounded-full bg-blue-100 flex items-center justify-center mb-4 shadow-inner">
                <i class="fas fa-calendar-check text-blue-600 text-3xl"></i>
            </div>
            <h3 class="text-2xl font-semibold text-gray-800 mb-4">¡Programa tu cita médica con facilidad!</h3>

            <div class="space-y-4 text-left w-full max-w-md">
                <div class="flex items-start">
                    <div class="flex-shrink-0 text-blue-500 mt-1 mr-2">
                        <i class="fas fa-clock"></i>
                    </div>
                    <p class="text-gray-700">Por favor, presenta tu <span class="font-semibold">DNI y seguro médico</span>, y llega <span class="text-blue-600 font-semibold">10 minutos antes</span> de tu cita.</p>
                </div>

                <div class="flex items-start">
                    <div class="flex-shrink-0 text-blue-500 mt-1 mr-2">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <p class="text-gray-700">
                        Puedes cancelar hasta <span class="font-semibold">24 horas antes</span>. Pasado este plazo, no podrás cancelar la cita.
                    </p>
                </div>
                <div class="flex items-start">
                    <div class="flex-shrink-0 text-blue-500 mt-1 mr-2">
                        <i class="fas fa-exclamation-circle"></i>
                    </div>
                    <p class="text-gray-700">
                        Si no asistes a tu cita <span class="font-semibold">en la fecha indicada</span>, esta se considerará como una <span class="text-red-500 font-semibold">cita perdida</span>.
                    </p>
                </div>


                <div class="flex items-start">
                    <div class="flex-shrink-0 text-blue-500 mt-1 mr-2">
                        <i class="fas fa-user-md"></i>
                    </div>
                    <p class="text-gray-700">Nuestros doctores están listos para atenderte con profesionalismo y calidez.</p>
                </div>
            </div>

            <div class="mt-6 pt-4 border-t border-blue-100 w-full">
                <p class="text-sm text-blue-600 font-medium">Tu salud es nuestra prioridad</p>
                <p class="text-xs text-gray-500 mt-1">Reserva ahora y da el primer paso hacia tu bienestar</p>
            </div>
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
