<div id="listaMisCitas" class="bg-white shadow-lg rounded-lg p-6 flex-1 lg:ml-4" style="display:none;">
    <ul id="citasList" class="space-y-4">
        <!-- Lista de citas -->
    </ul>

    <!-- Contenedor para la paginación -->
    <div id="pagination" class="flex justify-center space-x-4 mt-6">
        <!-- Paginación será añadida aquí -->
    </div>
</div>

<!-- Script para cargar las citas -->
<script>
    let page = 1; // Variable para controlar la página actual

    // Función para cargar las citas
    window.cargarCitas = function() {
        const citasList = document.getElementById('citasList');
        citasList.innerHTML = '<p class="text-center text-gray-600">Cargando citas...</p>';

        fetch('{{ route('citas.usuario') }}?page=' + page)
            .then(response => {
                if (!response.ok) {
                    throw new Error('Error HTTP: ' + response.status);
                }
                return response.json();
            })
            .then(citas => {
                citasList.innerHTML = '';
                if (citas.data.length === 0) {
                    citasList.innerHTML = '<p class="text-center text-gray-600">No tienes citas registradas.</p>';
                } else {
                    citas.data.forEach(cita => {
                        const li = document.createElement('li');
                        li.className = 'bg-gray-100 rounded-lg p-4 shadow-lg flex justify-between items-center space-x-6 transition-all hover:bg-gray-200';

                        const hora24 = convertirHoraA24Horas(cita.horario.hora);
                        if (!hora24) return;

                        // Crear la fecha completa de la cita en formato de 24 horas
                        const horaInicio = cita.horario.hora.split(' - ')[0]; // Hora de inicio
                        const horaFin = cita.horario.hora.split(' - ')[1]; // Hora de fin

                        const fechaInicio = new Date(`${cita.horario.fecha}T${convertirHoraA24Horas(horaInicio)}:00`);
                        const fechaFin = new Date(`${cita.horario.fecha}T${convertirHoraA24Horas(horaFin)}:00`);
                        const ahora = new Date();

                        // Calcular la diferencia entre la hora actual y la hora de la cita
                        const diffTiempo = (fechaInicio - ahora) / (1000 * 60); // Diferencia en minutos
                        const diferencia = `${Math.floor(diffTiempo / 60)} horas y ${Math.abs(Math.floor(diffTiempo % 60))} minutos`;

                        // Comparar las fechas completas (fecha + hora)
                        const citaPasada = fechaFin < ahora; // Si la fecha y hora de la cita ya ha pasado
                        const puedeCancelar = !citaPasada && (fechaInicio - ahora) > 1000 * 60 * 60 * 24 && cita.estado === 0; // Comparación de más de 24 horas

                        // Verificar si la cita está en proceso
                        const citaEnProceso = fechaInicio <= ahora && fechaFin >= ahora;

                        // Generar el contenido de la cita
                        li.innerHTML = `
                        <div class="flex-grow">
                            <p class="text-xl font-semibold text-gray-700">Doctor: ${cita.doctor.nombre} ${cita.doctor.apellido}</p>
                            <p class="text-gray-600">Especialidad: <span class="font-medium">${cita.doctor.especialidad}</span></p>
                            <p class="text-gray-600">Fecha: <span class="font-medium">${cita.horario.fecha}</span></p>
                            <p class="text-gray-600">Hora: <span class="font-medium">${cita.horario.hora}</span></p>
                           <p class="text-gray-600">Estado:
<span class="font-medium
        ${cita.estado === 1 ? 'text-green-500' :
                            citaPasada ? 'text-red-500' :
                                (citaEnProceso ? 'text-blue-500' : 'text-yellow-500')
                        }">
        ${
                            cita.estado === 1 ? 'Atendida' :
                                citaPasada ? 'Cita perdida (Ya pasó)' :
                                    citaEnProceso ? 'Cita en proceso' :
                                        'Pendiente'
                        }
    </span>
</p>


                        </div>
                       <div class="flex-shrink-0">
    ${
                            cita.estado === 1 // Si la cita está atendida, no mostrar nada
                                ? ''
                                : ( // Si no está atendida, muestra solo el botón de cancelar si es posible
                                    puedeCancelar
                                        ? `<button onclick="cancelarCita(${cita.id})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500">Cancelar cita</button>`
                                        : ''
                                )
                        }
</div>

                    `;
                        citasList.appendChild(li);
                    });

                    // Mostrar los botones de paginación
                    const pagination = document.getElementById('pagination');
                    pagination.innerHTML = ''; // Limpiar los botones de paginación previos

                    if (citas.prev_page_url) {
                        const prevButton = document.createElement('button');
                        prevButton.className = 'py-2 px-4 bg-gray-800 text-white font-semibold rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2';
                        prevButton.innerText = 'Anterior';
                        prevButton.onclick = function() {
                            page--;
                            cargarCitas();
                        };
                        pagination.appendChild(prevButton);
                    }

                    for (let i = 1; i <= citas.last_page; i++) {
                        const pageButton = document.createElement('button');
                        pageButton.className = `py-2 px-4 ${i === page ? 'bg-red-600' : 'bg-gray-800'} text-white font-semibold rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2`;
                        pageButton.innerText = i;
                        pageButton.onclick = function() {
                            page = i;
                            cargarCitas();
                        };
                        pagination.appendChild(pageButton);
                    }

                    if (citas.next_page_url) {
                        const nextButton = document.createElement('button');
                        nextButton.className = 'py-2 px-4 bg-gray-800 text-white font-semibold rounded-lg hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2';
                        nextButton.innerText = 'Siguiente';
                        nextButton.onclick = function() {
                            page++;
                            cargarCitas();
                        };
                        pagination.appendChild(nextButton);
                    }
                }
            })
            .catch(error => {
                console.error('Error al cargar citas:', error);
                citasList.innerHTML = '<p class="text-center text-red-500">Error al cargar citas. Detalle: ' + error.message + '</p>';
            });
    };

    // Recargar las citas cuando se haga clic en el botón de mis citas
    document.getElementById('misCitasBtn').addEventListener('click', function() {
        cargarCitas(); // Recargar las citas al hacer clic
        document.getElementById('listaMisCitas').style.display = 'block'; // Mostrar la sección de citas
    });
</script>

<!-- Script para convertir la hora de 12 horas a 24 horas -->
<script>
    function convertirHoraA24Horas(hora12) {
        if (!hora12) return null;

        const [time, modifier] = hora12.split(' ');

        if (!time || !modifier) return null;

        let [hours, minutes] = time.split(':');
        hours = parseInt(hours, 10);

        if (modifier === 'AM' && hours === 12) {
            hours = 0;
        } else if (modifier === 'PM' && hours < 12) {
            hours += 12;
        }

        return hours.toString().padStart(2, '0') + ':' + minutes.padStart(2, '0');
    }
</script>

<!-- Script para manejar la cancelación de citas -->
<script>
    // Función para cancelar la cita
    function cancelarCita(citaId) {
        if (confirm("¿Estás seguro de que quieres cancelar esta cita?")) {
            fetch('{{ route('cancelar.cita') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    cita_id: citaId
                })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        alert(data.message); // Muestra el mensaje que devuelve la API
                        cargarCitas(); // Recargar las citas después de cancelar
                    }
                })
                .catch(error => {
                    console.error('Error al cancelar cita:', error);
                    alert('Hubo un error al cancelar la cita.');
                });
        }
    }
</script>
