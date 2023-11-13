<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class rutaController extends Controller
{
  

    public function crearRuta(Request $request)
    {try{
        $response2 = Http::withHeaders([
            'X-CSRF-TOKEN'=>$request->input('X-CSRF-TOKEN'),
            "Authorization"=>$request->input('Authorization'),
            "Accept" =>$request->input('Accept'),
            "Content-Type"=>$request->input('Content-Type'),
        ])->post('http://127.0.0.1:8003/api/ruta', [
            'id_usuario' => $request->input('userId'),
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
        }
        Session::put('coordenadas', $coordenadas);
        return response()->json('Datos de ubicaciones obtenidos correctamente');
    }catch(\Exception $e){
        return response()->json('Error, no se pudo calcular la ruta');
    }
    }
}
