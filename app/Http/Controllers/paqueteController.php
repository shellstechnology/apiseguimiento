<?php

namespace App\Http\Controllers;

use Http;
use Illuminate\Http\Request;
use Session;

class paqueteController extends Controller
{
    public function cargarDatos(){
        $response = Http::get('http://127.0.0.1:8003/api/paquetes');
        $data = $response->json();
        Session::put('paquete', $data[0]);
        Session::put('estadoPaquete', $data[1]);
        return redirect()->route('paqueteCamion');
    }

    public function cambiarEstado(Request $request){
        $response=Http::post('http://127.0.0.1:8003/api/paquete', [
            'paquetes' => $request->input('paquete_seleccionado'),
        ]);
        
    }
}
