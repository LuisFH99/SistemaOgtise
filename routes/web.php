<?php

use App\Http\Controllers\DocentesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EntradaController;
use App\Http\Controllers\SalidaController;
use App\Http\Controllers\ValidaSalidaController;
use App\Http\Controllers\LicenciasController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ContactanosController;
use App\Http\Controllers\ValidaLicenciaController;
use App\Http\Livewire\Admin\UsersIndex;
use App\Http\Livewire\LicenciasIndex;
use App\Http\Livewire\ValidarSalidasIndex;
use App\Http\Livewire\ValidaLicenciaIndex;
use App\Mail\ContactanosMailable;
use App\Http\Controllers\ParteDiarioController;
use Illuminate\Support\Facades\Mail;

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

Route::get('/Admin/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])/*->middleware('can:admin.home')*/->name('home');

//Route::get('/docentes/licencias', [LicenciasController::class, 'index'])/*->middleware('can:licencia')*/->name('licencias');
Route::resource('/departamento/ValidaSalida', ValidaSalidaController::class)->names([
    'index'=>'ValidaSalida'
]);

Route::get('docentes/entrada', [EntradaController::class, 'index'])/*->middleware('can:asistencia.Entrada')*/->name('entrada');
//Route::get('docentes/salida', [SalidaController::class, 'index'])/*->middleware('can:asistencia.Salida')*/->name('salida');
//Route::post('docentes/entrada/registrar', [EntradaxController::class, 'store'])->name('docentes.entrada.registrar');
Route::post('/docentes/registros/asistencia/All', [EntradaController::class, 'allregistros']);
Route::post('/docentes/registros/asistencia/Detalle', [EntradaController::class, 'detalleregistro']);
Route::post('/docentes/entrada/registrar', [EntradaController::class, 'store'])->name('registrar');
Route::post('/docentes/salida/registrar', [EntradaController::class, 'registrarsalida'])->name('registrar.salida');
Route::post('/docentes/salida/file', [EntradaController::class, 'evidenciafile'])->name('evidencia.file');
//Route::post('/docentes/salida/registrar', [SalidaController::class, 'store'])->name('registrar.salida');

Route::get('/URyC/ParteDiario', [ParteDiarioController::class, 'index'])->name('partediario');
Route::get('/URyC/ParteDiario/general/{fecha}', [ParteDiarioController::class, 'reportegeneral'])->name('reportegeneral');
// Route::post('/URyC/ParteDiario/reporte', [ParteDiarioController::class, 'reportedocente']);
Route::get('/URyC/ParteDiario/reporte/{id}/{mes}/{aa}', [ParteDiarioController::class, 'reportedocente']);


Route::get('/departamento/docentes', [DocentesController::class, 'index'])->name('docentes');
Route::get('/departamento/creardocente', [DocentesController::class, 'create'])->name('creardocente');
Route::post('/departamento/docentes/store',[DocentesController::class,'store'])->name('docentes.store');

Route::post('/departamento/docentes/edit',[DocentesController::class,'edit'])->name('docentes.edit');
Route::get('/departamento/docentes/editSemana/{id}',[DocentesController::class,'editSemana'])->name('docentes.editSemana');
Route::put('/departamento/docentes/updateSemana/{id}',[DocentesController::class,'updateSemana'])->name('docentes.updateSemana');
Route::post('/departamento/docentes/dpto',[DocentesController::class,'dpto']);
Route::post('/departamento/docentes/update',[DocentesController::class,'update']);
Route::post('/departamento/docentes/delete',[DocentesController::class,'destroy']);

//CRUD 
Route::resource('/Admin/files', App\Http\Controllers\Admin\FileController::class)->names([
    'index' => 'Admin.files.index',
    'create' => 'Admin.files.create',
    'show' => 'Admin.files.show',
    'store' => 'Admin.file.store'
]);
//
Route::resource('/docentes/licencias', App\Http\Controllers\LicenciasController::class)->names([
    'index' => 'licencias',
    'create' => 'licencias.create',
    'show' => 'licencias.show'
]);
Route::post('/docentes/licencias/store', [LicenciasController::class, 'store'])->name('licencias.store');
Route::post('/docentes/licencias/file', [LicenciasController::class, 'file'])->name('licencias.file');
Route::post('/docentes/licencias/dato', [LicenciasController::class, 'dato'])->name('licencias.dato');
Route::post('/docentes/PDFs/imprimir', [LicenciasController::class, 'imprimir'])->name('licencias.imprimir');
Route::post('/docentes/licencias/eliminar', [LicenciasController::class, 'eliminar'])->name('licencias.eliminar');

Route::resource('users', App\Http\Controllers\Admin\UserController::class)->names([
    'index' => 'Users',
    'edit' => 'Admin.users.edit',
    'update'=> 'Admin.users.update'
]);

Route::post('/users/index/datos', [UsersIndex::class, 'datos'])->name('datos');
Route::get('/users/index/roles', [UsersIndex::class, 'devolverRoles'])->name('roles.datos');

Route::resource('/contactanos', App\Http\Controllers\ContactanosController::class)->names([
    'index' => 'contactanos.index',
    'store' => 'contactanos.store'
]);
Route::post('/licencia/index/datos', [LicenciasIndex::class, 'datos'])->name('datos1');

Route::post('/Departamento/index/validando', [ValidarSalidasIndex::class, 'validando'])->name('validando');
Route::post('/Departamento/ValidaSalida/dato', [ValidaSalidaController::class, 'dato'])->name('ValidaSalida.dato');

Route::resource('/departamento/ValidaLicencia', ValidaLicenciaController::class)->names([
    'index'=>'ValidaLicencia',
    'store'=>'ValidaLicencia.store'
]);
Route::post('/departamento/ValidaLicencia/store', [ValidaLicenciaController::class, 'store'])->name('licencias.store');
Route::post('/departamento/ValidaLicencia/datos', [ValidaLicenciaController::class, 'datos'])->name('ValidaLicencia.datos');
Route::post('/departamento/ValidaLicencia/imprimir', [ValidaLicenciaController::class, 'imprimir'])->name('ValidaLicencia.imprimir');