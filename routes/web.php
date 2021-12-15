<?php

use App\Http\Controllers\DocentesController;
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


Auth::routes();

Route::get('/Admin/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->name('home');

Route::get('/docentes/licencias', [LicenciasController::class, 'index'])->name('licencias');
Route::get('/departamento/ValidaSalida', [ValidaSalidaController::class, 'index'])->name('ValidaSalida');

Route::get('docentes/entrada', [EntradaController::class, 'index'])->name('entrada');
Route::get('docentes/salida', [SalidaController::class, 'index'])->name('salida');

Route::post('/docentes/entrada/registrar', [EntradaController::class, 'store'])->name('registrar');
Route::post('/docentes/salida/registrar', [SalidaController::class, 'store'])->name('registrar.salida');

Route::get('/departamento/docentes', [DocentesController::class, 'index'])->name('docentes');







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