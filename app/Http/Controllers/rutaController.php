<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class rutaController extends Controller
{
    public function cargarDatos()
    {
        $response = Http::get('http://127.0.0.1:8003/api/ruta');
        $data = $response->json();
        Session::put('matriculaCamiones', $data);
        return redirect()->route('rutaCamion');
    }

    public function crearRuta(Request $request)
    {
        $response = Http::get('http://127.0.0.1:8003/api/chofer', [
            'matricula' => $request->input('idCamion')
        ]);
        $idUsuario = $response->json();
        $response2 = Http::post('http://127.0.0.1:8003/api/ruta', [
            'id_usuario' => $idUsuario
        ]);
        $coordenadas = [];
        $datosCoordenadas = $response2->json();
        if ($datosCoordenadas) {
            foreach ($datosCoordenadas as $elemento) {
                foreach ($elemento as $innerArray) {
                    if (isset($innerArray['Latitud']) && isset($innerArray['Longitud'])) {
                        $coordenadas[] = [
                            'Latitud' => $innerArray['Latitud'],
                            'Longitud' => $innerArray['Longitud'],
                        ];
                    }
                }
            }
            Session::put('coordenadas', $coordenadas);
        }
        return redirect()->route('rutaCamion');
    }
}
