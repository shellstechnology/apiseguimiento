<?php

namespace App\Http\Controllers;

use Http;
use Illuminate\Http\Request;
use Session;

class paqueteController extends Controller
{
    public function cargarDatos(Request $request)
    {
        try {
            $userId=$request->input("userId");
            $response = Http::get("http://127.0.0.1:8003/api/paquetes/$userId");
            $data = $response->json();
            Session::put('paquete', $data[0]);
            Session::put('estadoPaquete', $data[1]);
            return response()->json('Datos cargados correctamente');
        } catch (\Exception $e) {
            return response()->json('Error, no se pudo cargar los datos');
        }
    }

    public function cambiarEstado(Request $request)
    {
        try {
            $response = Http::withHeaders([
                'X-CSRF-TOKEN' => $request->input('X-CSRF-TOKEN'),
                "Authorization" => $request->input('Authorization'),
                "Accept" => $request->input('Accept'),
                "Content-Type" => $request->input('Content-Type'),
            ])->post('http://127.0.0.1:8003/api/paquete', [
                        'paquetes' => $request->input('paquete_seleccionado'),
                        'userId'=> $request->input('userId')
                    ]);
            return response()->json('Estados cambiados correctamente');
        } catch (\Exception $e) {
            return response()->json('Error, no se pudo cambiar los estados');
        }
    }
}
