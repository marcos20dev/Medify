<?php

namespace App\Http\Controllers;

use App\Models\Loginpacientes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Usuario;
use App\Models\Regione;
use App\Models\Provincia;
use App\Models\Distrito;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;


class RegistroController extends Controller
{
    public function mostrarFormulario()
    {
        $regiones = Regione::pluck('Region', 'idReg'); // Recupera las regiones de la base de datos

        return view('vistas.cita.login.registro', compact('regiones'));
    }

    public function obtenerProvincias(Request $request)
    {
        $regionId = $request->input('region_id');
        $provincias = Provincia::where('idReg', $regionId)->pluck('Provincia', 'idProv');

        return response()->json($provincias);
    }

    public function obtenerDistritos(Request $request)
    {
        $provinciaId = $request->input('provincia_id');
        $distritos = Distrito::where('idProv', $provinciaId)->pluck('Distrito', 'idDist');

        return response()->json($distritos);
    }


    public function guardar(Request $request)
    {
        Log::info('Entró al método guardar');

        try {
            $validated = $request->validate([
                'TipoDoc' => 'required|string',
                'Numdoc' => 'required|string|size:8',
                'Nombre' => 'required|string',
                'ApePaterno' => 'required|string',
                'ApeMaterno' => 'required|string',
                'Telefono' => 'required|string',
                'Fechanac' => 'required|date',
                'Genero' => 'required|string',
                'Region' => 'required|exists:regiones,idReg',
                'Provincia' => 'required|exists:provincias,idProv',
                'Distrito' => 'required|exists:distritos,idDist',
                'Direccion' => 'required|string',
                'Gmail' => 'nullable|email',
                'password' => 'required|string|min:8|confirmed',
            ]);

            Log::info('Validación exitosa', $validated);

            $paciente = new User();
            $paciente->TipoDoc = $request->input('TipoDoc');
            $paciente->Numdoc = $request->input('Numdoc');
            $paciente->Nombre = $request->input('Nombre');
            $paciente->ApePaterno = $request->input('ApePaterno');
            $paciente->ApeMaterno = $request->input('ApeMaterno');
            $paciente->Telefono = $request->input('Telefono');

            // 🔥 Aquí convertimos la fecha al formato correcto
            $fechaOriginal = $request->input('Fechanac');
            $fechaFormateada = Carbon::createFromFormat('d-m-Y', $fechaOriginal)->format('Y-m-d');
            $paciente->Fechanac = $fechaFormateada;

            $paciente->Genero = $request->input('Genero');
            $paciente->Region = $request->input('Region');
            $paciente->Provincia = $request->input('Provincia');
            $paciente->Distrito = $request->input('Distrito');
            $paciente->Direccion = $request->input('Direccion');
            $paciente->Gmail = $request->input('Gmail');
            $paciente->password = Hash::make($request->input('password'));

            $paciente->save();

            Log::info('Paciente guardado correctamente', ['id' => $paciente->id]);

            return redirect()->route('login')->with('success', '¡Registro exitoso!');
        } catch (\Throwable $e) {
            Log::error('Error en guardar', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return back()->with('error', 'Error al registrar. Revisa los logs.');
        }
    }

}
