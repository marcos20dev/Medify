<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // Asegúrate de importar la fachada Log

class ApiController extends Controller
{

    public function consultaDNI(Request $request)
    {
        $dni = $request->input('dni');
        $token = env('API_TOKEN');

        $client = new Client([
            'base_uri' => 'https://api.apis.net.pe',
            'verify' => false,
            'http_errors' => false
        ]);

        $response = $client->request('GET', '/v2/reniec/dni', [
            'connect_timeout' => 5,
            'headers' => [
                'Authorization' => 'Bearer ' . $token,
                'Accept' => 'application/json',
            ],
            'query' => ['numero' => $dni]
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        // Verifica si se recibieron datos y si los campos necesarios están presentes
        if (!empty($data) && isset($data['nombres']) && isset($data['apellidoPaterno']) && isset($data['apellidoMaterno'])) {
            Log::info('Respuesta API exitosa', ['Data' => $data]);
            return response()->json($data);
        } else {
            Log::warning('No se encontraron datos', ['DNI' => $dni]);
            return response()->json(['error' => 'No se encontraron datos para el DNI ingresado.']);
        }
    }

}
