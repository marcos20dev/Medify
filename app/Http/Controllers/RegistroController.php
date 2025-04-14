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
        // Validación de los campos
        $validated = $request->validate([
            'TipoDoc' => 'required|string',
            'Numdoc' => 'required|string|size:8',  // Validación para DNI de 8 caracteres
            'Nombre' => 'required|string',
            'ApePaterno' => 'required|string',
            'ApeMaterno' => 'required|string',
            'Telefono' => 'required|string',
            'Fechanac' => 'required|date',
            'Genero' => 'required|string',
            'Region' => 'required|exists:regiones,idReg', // Validar que la región existe
            'Provincia' => 'required|exists:provincias,idProv',
            'Distrito' => 'required|exists:distritos,idDist',
            'Direccion' => 'required|string',
            'Gmail' => 'nullable|email',
            'password' => 'required|string|min:8|confirmed',  // Validación de la contraseña (con confirmación)
        ]);

        // Continuar con el almacenamiento si los datos son válidos
        $paciente = new User();
        $paciente->TipoDoc = $request->input('TipoDoc');
        $paciente->Numdoc = $request->input('Numdoc');
        $paciente->Nombre = $request->input('Nombre');
        $paciente->ApePaterno = $request->input('ApePaterno');
        $paciente->ApeMaterno = $request->input('ApeMaterno');
        $paciente->Telefono = $request->input('Telefono');
        $paciente->Fechanac = $request->input('Fechanac');
        $paciente->Genero = $request->input('Genero');
        $paciente->Region = $request->input('Region');
        $paciente->Provincia = $request->input('Provincia');
        $paciente->Distrito = $request->input('Distrito');
        $paciente->Direccion = $request->input('Direccion');
        $paciente->Gmail = $request->input('Gmail');
        $paciente->password = Hash::make($request->input('password'));

        $paciente->save();

        return redirect()->route('login')->with('success', '¡Registro exitoso!');

    }
}
