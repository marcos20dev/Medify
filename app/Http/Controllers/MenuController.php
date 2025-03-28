<?php
namespace App\Http\Controllers;

use App\Models\Doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MenuController extends Controller
{
    public function menu()
    {
        // Obtener el usuario autenticado
        $usuario = Auth::user();
        $usuario->load(['provincia', 'region', 'distrito']);

        // Recupera las especialidades distintas de la base de datos
        $especialidades = Doctor::distinct()->pluck('especialidad');

        // Retorna la vista con el usuario y las especialidades
        return view('vistas.cita.menu.menu', [
            'usuario' => $usuario,
            'especialidades' => $especialidades,
        ]);
    }


}
