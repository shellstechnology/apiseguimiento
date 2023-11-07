<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\paqueteController;
use App\Http\Controllers\rutaController;

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

Route::get('/', function () {
    return view('mapa');
});

Route::get('/paqueteCamion', function () {
    return view('paqueteCamion');
})->name('paqueteCamion');

Route::get('/rutaCamion', function () {
    return view('rutaCamion');
})->name('rutaCamion');

Route::get('/PaqueteCamion', [paqueteController::class, 'cargarDatos'])->name('paqueteCamiom.cargarDatos');
Route::post('/paqueteCamion', [paqueteController::class, 'cambiarEstado'])->name('redireccion.paqueteCamion');

Route::get('/RutaCamion', [rutaController::class, 'cargarDatos'])->name('rutaCamion.cargarDatos');
Route::post('/rutaCamion', [rutaController::class, 'crearRuta'])->name('redireccion.rutaCamion');