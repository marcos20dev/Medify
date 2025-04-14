<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Cita;
use App\Models\Horario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

// Importa el facade Log

class CitasController extends Controller
{
    public function obtenerEspecialidades()
    {
        $especialidades = Doctor::distinct()->pluck('especialidad');
        return view('vistas.cita.menu.reservar_cita', compact('especialidades'));
    }

    public function obtenerDoctoresPorEspecialidad(Request $request)
    {
        $especialidad = $request->input('especialidad');
        $doctores = Doctor::where('especialidad', $especialidad)->get();
        return response()->json($doctores);
    }

    public function obtenerHorarios(Request $request)
    {
        $dniDoctor = $request->input('dni_doctor');
        $fecha = $request->input('fecha');

        $horarios = Horario::where('dni_doctor', $dniDoctor)
            ->where('fecha', $fecha)
            ->where('ocupado', false) // Solo horarios no ocupados
            ->get();

        // Retornar los horarios en formato JSON
        return response()->json($horarios);
    }


    public function store(Request $request)
    {
        try {
            // Validar los datos recibidos
            $validatedData = $request->validate([
                'doctor_id' => 'required|exists:doctor,dni', // Verificar el DNI en la tabla 'doctor'
                'horario_id' => 'required|exists:horarios,id',
                'user_id' => 'required|exists:users,id'
            ]);


            // Crear una nueva cita
            $cita = new Cita();
            $cita->doctor_id = $request->input('doctor_id');
            $cita->horario_id = $request->input('horario_id');
            $cita->users_id = $request->input('user_id'); // Asegúrate de que esta línea use 'users_id'
            $cita->estado = false; // Representando 'Pendiente' como 'false'
            $cita->save();


            // Actualizar el estado de 'ocupado' en la tabla de horarios
            $horario = Horario::find($request->input('horario_id'));
            if ($horario) {
                $horario->ocupado = true; // Cambiar a true
                $horario->save(); // Guardar los cambios en la tabla de horarios
            }

            // Retornar una respuesta JSON
            return response()->json(['message' => 'Cita registrada exitosamente', 'citaId' => $cita->id], 200);
        } catch (\Illuminate\Validation\ValidationException $ve) {
            return response()->json(['message' => 'Validación fallida', 'errors' => $ve->errors()], 422);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Ocurrió un error al registrar la cita', 'error' => $e->getMessage()], 500);
        }
    }


    public function obtenerCitasUsuario(Request $request)
    {
        $userId = $request->user()->id; // ID del usuario autenticado

        // Obtener citas del usuario junto con el doctor y el horario, y agregar paginación
        $citas = Cita::with(['doctor', 'horario'])
            ->where('users_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate(4); // Paginar 5 citas por página (ajusta según tus necesidades)

        return response()->json($citas); // Devolver las citas en formato JSON
    }


    public function cancelarCita(Request $request)
    {
        $request->validate([
            'cita_id' => 'required|exists:citas,id',
        ]);

        $cita = Cita::find($request->input('cita_id'));

        if ($cita->users_id != $request->user()->id) {
            return response()->json(['message' => 'No tienes permiso para cancelar esta cita.'], 403);
        }

        $horaCita = explode(' - ', $cita->horario->hora)[0];  // Tomamos la hora de inicio antes del guion
        $fechaCita = Carbon::parse($cita->horario->fecha . ' ' . $horaCita, 'America/Lima');
        $ahora = Carbon::now('America/Lima');
        $diferenciaHoras = $fechaCita->diffInHours($ahora);

        if ($diferenciaHoras < 24) {
            // Si la cita ha pasado, marcarla como "Cita perdida"
            $cita->estado_perdido = 1; // Marcamos la cita como perdida
            $cita->save();
            return response()->json(['message' => 'No se puede cancelar la cita, ya ha pasado. Se marca como "Cita perdida".'], 400);
        }

        // Cambiar el estado del horario a disponible
        $horario = $cita->horario;
        if ($horario) {
            $horario->ocupado = false; // Cambiar el estado a disponible
            $horario->save();
        }

        // Eliminar la cita
        $cita->delete();

        return response()->json(['message' => 'Cita cancelada y eliminada exitosamente.'], 200);
    }




}
