<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Http;
use Session;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
        public function iniciarSesion(Request $request){
        $response=Http::withHeaders([
            "Accept"=> $request->input('aceptar'),
            "Content-Type"=> $request->input('Accept'),
        ])->post('http://127.0.0.1:8002/api/v1/login', [
            'name' => $request->input('name'),
           'password' => $request->input('password'),
        ]);
        return $response->json();
    }

    public function Logout(Request $request){
        Auth::logout();
        return redirect("/login")->with("logout",true);
    }
}
