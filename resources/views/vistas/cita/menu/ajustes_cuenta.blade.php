<div id="ajustesCuenta" class="bg-white shadow-md rounded-lg p-6 flex-1 lg:ml-4" style="display:none;">
    <h2 class="text-2xl font-bold mb-6 text-center text-gray-800">Ajustes de cuenta</h2>

    <!-- Contenedor principal -->
    <div class="space-y-6">

        <!-- Contenedor para "Perfil" -->
        <div class="flex mb-6">
            <!-- Título de Perfil a la izquierda -->
            <h3 class="text-xl font-semibold text-gray-700 w-1/4">Perfil
            </h3>

            <!-- Contenedor gris con campos de entrada -->
            <div class="bg-gray-200 p-6 rounded-lg w-3/4">
                <!-- Foto de perfil y opción de cambiarla -->
                <div class="flex items-center space-x-4">
                    <div class="w-20 h-20 rounded-full bg-gray-500 flex items-center justify-center text-white text-3xl">
                        LA
                    </div>
                </div>

                <!-- Nombre -->
                <div class="mb-4">
                    <label for="nombre" class="block text-gray-700 font-semibold mb-2">Nombre:</label>
                    <input type="text" id="nombre" value="{{ $usuario->Nombre }}"
                           class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                           placeholder="Nombre">
                </div>

                <!-- Apellido Paterno -->
                <div class="mb-4">
                    <label for="apePaterno" class="block text-gray-700 font-semibold mb-2">Apellido Paterno:</label>
                    <input type="text" id="apePaterno" value="{{ $usuario->ApePaterno }}"
                           class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                           placeholder="Apellido Paterno">
                </div>

                <!-- Apellido Materno -->
                <div class="mb-4">
                    <label for="apeMaterno" class="block text-gray-700 font-semibold mb-2">Apellido Materno:</label>
                    <input type="text" id="apeMaterno" value="{{ $usuario->ApeMaterno }}"
                           class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                           placeholder="Apellido Materno">
                </div>

                <!-- Correo electrónico -->
                <div class="mb-4">
                    <label for="email" class="block text-gray-700 font-semibold mb-2">Correo electrónico:</label>
                    <input type="email" id="email" value="{{ $usuario->Gmail }}"
                           class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                           placeholder="Correo electrónico">
                </div>

                <!-- Botón para guardar cambios -->
                <div class="flex justify-end mt-6">
                    <button type="submit"
                            class="bg-gray-800 text-white font-bold py-2 px-4 rounded-md hover:bg-gray-700 focus:ring-2 focus:ring-gray-500">
                        Guardar Cambios
                    </button>
                </div>
            </div>
        </div>
        <hr class="border-t border-gray-200 mb-6">

        <!-- Contenedor para "Contraseña" -->
        <div class="flex mb-6">
            <!-- Título de Contraseña a la izquierda -->
            <h3 class="text-xl font-semibold text-gray-700 w-1/4">Contraseña</h3>
            <!-- Contenedor gris con campos de entrada -->
            <div class="bg-gray-200 p-6 rounded-lg w-3/4">
                <!-- Nueva Contraseña -->
                <div class="mb-4">
                    <label for="password" class="block text-gray-700 font-semibold mb-2">Nueva Contraseña:</label>
                    <input type="password" id="password"
                           class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                           placeholder="Nueva contraseña">
                </div>

                <!-- Confirmar Contraseña -->
                <div class="mb-4">
                    <label for="confirmPassword" class="block text-gray-700 font-semibold mb-2">Confirmar Contraseña:</label>
                    <input type="password" id="confirmPassword"
                           class="mt-1 p-2 w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                           placeholder="Confirmar nueva contraseña">
                </div>

                <!-- Botón para guardar la nueva contraseña -->
                <div class="flex justify-end mt-6">
                    <button type="submit"
                            class="bg-gray-800 text-white font-bold py-2 px-4 rounded-md hover:bg-gray-700 focus:ring-2 focus:ring-gray-500">
                        Guardar Cambios
                    </button>
                </div>
            </div>
        </div>
        <hr class="border-t border-gray-200 mb-6">

        <!-- Contenedor para "Cuenta" -->
        <div class="flex mb-6">
            <!-- Título de Cuenta a la izquierda -->
            <h3 class="text-xl font-semibold text-gray-700 w-1/4">Cuenta</h3>
            <!-- Contenedor gris con información sobre la eliminación de cuenta -->
            <div class="bg-gray-200 p-6 rounded-lg w-3/4">
                <h3 class="text-xl font-semibold text-gray-700 mb-4">Eliminar Cuenta</h3>
                <p class="text-gray-600 mb-4">Si decides eliminar tu cuenta, perderás todos los datos relacionados. Asegúrate de que estás completamente seguro.</p>

                <!-- Botón para eliminar cuenta -->
                <div class="flex justify-end mt-6">
                    <button type="button"
                            class="bg-red-600 text-white font-bold py-2 px-4 rounded-md hover:bg-red-700 focus:ring-2 focus:ring-red-300">
                        Eliminar Cuenta
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
