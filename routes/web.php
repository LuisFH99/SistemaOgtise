<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/licencias', [App\Http\Controllers\LicenciasController::class, 'index'])->name('licencias');
Route::get('/ValidaSalida', [App\Http\Controllers\ValidaSalidaController::class, 'index'])->name('ValidaSalida');

Route::get('/entrada', [App\Http\Controllers\EntradaController::class, 'index'])->name('entrada');
Route::get('/salida', [App\Http\Controllers\SalidaController::class, 'index'])->name('salida');



//CRUD Route::resource('licencias', App\Http\Controllers\LicenciasController::class);
