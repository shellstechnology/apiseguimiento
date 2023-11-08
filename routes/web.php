<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\paqueteController;
use App\Http\Controllers\rutaController;
use App\Http\Controllers\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/login', function () {
    return view('login');
});
Route::post('/login', [LoginController::class, 'iniciarSesion'])->name('login');

Route::get('/set-test-cookie', function () {
    return response('Test cookie set')->cookie('test_cookie', 'test_value', 60);
});

Route::get('/', function () {
    return view('choferes');
});

Route::get('/mapa', function () {
    return view('mapa');
})->middleware(Autenticacion::class);

Route::get('/paqueteCamion', function () {
    return view('paqueteCamion');
})->name('paqueteCamion');

Route::get('/rutaCamion', function () {
    return view('rutaCamion');
})->name('rutaCamion');

Route::get('/PaqueteCamion', [paqueteController::class, 'cargarDatos'])->name('paqueteCamiom.cargarDatos')->middleware(Autenticacion::class);
Route::post('/paqueteCamion', [paqueteController::class, 'cambiarEstado'])->name('redireccion.paqueteCamion')->middleware(Autenticacion::class);

Route::get('/RutaCamion', [rutaController::class, 'cargarDatos'])->name('rutaCamion.cargarDatos')->middleware(Autenticacion::class);
Route::post('/rutaCamion', [rutaController::class, 'crearRuta'])->name('redireccion.rutaCamion')->middleware(Autenticacion::class);