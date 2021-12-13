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

Route::get('/docentes/licencias', function () {
    return view('licencias');
});

Route::get('/departamento/ValidaSalida', function () {
    return view('ValidaSalida');
});

Auth::routes();

Route::get('/Admin/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');

Route::get('/docentes/licencias', [App\Http\Controllers\LicenciasController::class, 'index'])->name('licencias');
Route::get('/departamento/ValidaSalida', [App\Http\Controllers\ValidaSalidaController::class, 'index'])->name('ValidaSalida');

Route::get('/salida', [SalidaController::class, 'index'])->name('salida');



//CRUD 
Route::resource('/Admin/files', App\Http\Controllers\Admin\FileController::class)->names([
    'index' => 'Admin.files.index',
    'create' => 'Admin.files.create',
    'show' => 'Admin.files.show',
    'store' => 'Admin.file.store'
]);
//
/*Route::resource('/docentes/Licencias', App\Http\Controllers\LicenciasController::class)->names([
    'index' => 'Admin.files.index',
    'create' => 'Admin.files.create',
    'show' => 'Admin.files.show',
    'store' => 'Admin.file.store'
]);*/