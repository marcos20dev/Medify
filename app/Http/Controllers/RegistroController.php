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
        if ($request->ajax()) {
            // Verificar si el Numdoc ya existe en la base de datos
            if (User::where('Numdoc', $request->input('Numdoc'))->exists()) {
                return response()->json(['success' => false, 'message' => 'El número de documento ya está registrado.'], 400);
            }

            // Guardar usuario
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

            return response()->json(['success' => true, 'message' => '¡Registro exitoso!']);
        }

        return redirect()->route('login')->with('success', '¡Registro exitoso!');
    }


}
