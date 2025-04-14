<?php

namespace App\Http\Controllers;
use Carbon\Carbon;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Cita;
class ConsultaCitaController extends Controller
{


    public function buscarCita(Request $request)
    {
        $request->validate([
            'dni' => 'required|digits:8',
        ]);

        // Buscar al usuario por su Numdoc (que es tu campo DNI)
        $usuario = User::where('Numdoc', $request->dni)->first();

        if (!$usuario) {
            return back()->with('mensaje', 'Usuario no encontrado');
        }

        // Obtener citas pendientes del usuario
        $citasPendientes = Cita::with(['doctor', 'horario'])
            ->where('users_id', $usuario->id)
            ->where('estado', 'pendiente')
            ->get();

        if ($citasPendientes->isEmpty()) {
            return back()->with('mensaje', 'No hay citas pendientes para este usuario.');
        }

        return back()->with([
            'mensaje' => 'Citas encontradas para el DNI ingresado.',
            'citas' => $citasPendientes,
        ]);
    }




    public function listarDoctores()
    {

    }

}
