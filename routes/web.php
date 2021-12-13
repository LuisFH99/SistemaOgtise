<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\SalidaController;
use App\Http\Controllers\ValidaSalidaController;
use App\Http\Controllers\LicenciasController;

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
    return view('auth/login');
});

Route::get('/licencias', function () {
    return view('licencias');
});
Route::get('/ValidaSalida', function () {
    return view('ValidaSalida');
});

Auth::routes();


Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::get('/licencias', [LicenciasController::class, 'index'])->name('licencias');

Route::get('/ValidaSalida', [ValidaSalidaController::class, 'index'])->name('ValidaSalida');

Route::get('/entrada', [EntradaController::class, 'index'])->name('entrada');

Route::post('/entrada/registrar',[EntradaController::class, 'store'])->name('registar.entrada');

Route::get('/salida', [SalidaController::class, 'index'])->name('salida');



//CRUD Route::resource('licencias', App\Http\Controllers\LicenciasController::class);
