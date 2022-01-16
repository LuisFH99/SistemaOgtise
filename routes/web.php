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

Route::get('/Admin/home', [App\Http\Controllers\Admin\HomeController::class, 'index'])->middleware('can:admin.home')->name('home');

//Route::get('/docentes/licencias', [LicenciasController::class, 'index'])/*->middleware('can:licencia')*/->name('licencias');
Route::resource('/departamento/ValidaSalida', ValidaSalidaController::class)->middleware('can:valida.Salida')->names([
    'index'=>'ValidaSalida'
]);

Route::get('docentes/entrada', [EntradaController::class, 'index'])->middleware('can:asistencia.Entrada')->name('entrada');
//Route::get('docentes/salida', [SalidaController::class, 'index'])/*->middleware('can:asistencia.Salida')*/->name('salida');
//Route::post('docentes/entrada/registrar', [EntradaxController::class, 'store'])->name('docentes.entrada.registrar');
Route::post('/docentes/registros/asistencia/All', [EntradaController::class, 'allregistros']);
Route::post('/docentes/registros/asistencia/Detalle', [EntradaController::class, 'detalleregistro']);
Route::post('/docentes/entrada/registrar', [EntradaController::class, 'store'])->middleware('can:asistencia.Entrada')->name('registrar');
Route::post('/docentes/salida/registrar', [EntradaController::class, 'registrarsalida'])->middleware('can:asistencia.Salida')->name('registrar.salida');
Route::post('/docentes/salida/file', [EntradaController::class, 'evidenciafile'])->middleware('can:asistencia.Salida')->name('evidencia.file');
//Route::post('/docentes/salida/registrar', [SalidaController::class, 'store'])->name('registrar.salida');

Route::get('/URyC/ParteDiario', [ParteDiarioController::class, 'index'])->middleware('can:reportes.parteDiario')->name('partediario');
Route::post('/URyC/docentes/registros/asistencia', [ParteDiarioController::class, 'allAsistencias'])->middleware('can:reportes.parteDiario');
Route::post('/URyC/docentes/registros/asistencia/justificar', [ParteDiarioController::class, 'justificarAsistencia'])->middleware('can:reportes.parteDiario');
Route::get('/URyC/ParteDiario/general/{fecha}', [ParteDiarioController::class, 'reportegeneral'])->middleware('can:reportes.parteDiario')->name('reportegeneral');
Route::get('/URyC/ParteDiario/general/faltas/{fecha}', [ParteDiarioController::class, 'reportegeneralfaltas'])->middleware('can:reportes.parteDiario')->name('reportegeneralfaltas');
Route::get('/URyC/ParteDiario/reporte/{id}/{mes}/{aa}', [ParteDiarioController::class, 'reportedocente'])->middleware('can:reportes.parteDiario');
// Route::get('/URyC/ParteDiario', [ParteDiarioController::class, 'index'])->middleware('can:reportes.parteDiario')->name('partediario');
// Route::get('/URyC/ParteDiario/general/{fecha}', [ParteDiarioController::class, 'reportegeneral'])->middleware('can:reportes.parteDiario')->name('reportegeneral');
//Route::post('/URyC/ParteDiario/reporte', [ParteDiarioController::class, 'reportedocente']);
// Route::get('/URyC/ParteDiario/reporte/{id}/{mes}/{aa}', [ParteDiarioController::class, 'reportedocente'])->middleware('can:reportes.parteDiario');


Route::get('/departamento/docentes', [DocentesController::class, 'index'])->middleware('can:gestion.docente')->name('docentes');
Route::get('/departamento/creardocente', [DocentesController::class, 'create'])->middleware('can:gestion.docente')->name('creardocente');
Route::post('/departamento/docentes/store',[DocentesController::class,'store'])->middleware('can:gestion.docente')->name('docentes.store');

Route::post('/departamento/docentes/edit',[DocentesController::class,'edit'])->middleware('can:gestion.docente')->name('docentes.edit');
Route::get('/departamento/docentes/editSemana/{id}',[DocentesController::class,'editSemana'])->middleware('can:gestion.docente')->name('docentes.editSemana');
Route::get('/departamento/docentes/cargo/{id}',[DocentesController::class,'CrearCargo'])->middleware('can:gestion.docente')->name('docentes.crear.cargo');
Route::post('/departamento/docentes/cargo/eliminar',[DocentesController::class,'EliminarCargo'])->middleware('can:gestion.docente')->name('docentes.eliminar.cargo');
Route::put('/departamento/docentes/updateSemana/{id}',[DocentesController::class,'updateSemana'])->middleware('can:gestion.docente')->name('docentes.updateSemana');
// Route::post('/departamento/docentes/edit',[DocentesController::class,'edit'])->middleware('can:gestion.docente')->name('docentes.edit');
// Route::get('/departamento/docentes/editSemana/{id}',[DocentesController::class,'editSemana'])->middleware('can:gestion.docente')->name('docentes.editSemana');
// Route::put('/departamento/docentes/updateSemana/{id}',[DocentesController::class,'updateSemana'])->middleware('can:gestion.docente')->name('docentes.updateSemana');
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
Route::resource('/docentes/licencias', App\Http\Controllers\LicenciasController::class)->middleware('can:licencia')->names([
    'index' => 'licencias',
    'create' => 'licencias.create',
    'show' => 'licencias.show'
]);
Route::post('/docentes/licencias/store', [LicenciasController::class, 'store'])->middleware('can:licencia')->name('licencias.store');
Route::post('/docentes/licencias/file', [LicenciasController::class, 'file'])->middleware('can:licencia')->name('licencias.file');
Route::post('/docentes/licencias/dato', [LicenciasController::class, 'dato'])->middleware('can:licencia')->name('licencias.dato');
Route::post('/docentes/PDFs/imprimir', [LicenciasController::class, 'imprimir'])->middleware('can:licencia')->name('licencias.imprimir');
Route::post('/docentes/licencias/eliminar', [LicenciasController::class, 'eliminar'])->middleware('can:licencia')->name('licencias.eliminar');

Route::resource('users', App\Http\Controllers\Admin\UserController::class)->middleware('can:admin.users.index')->names([
    'index' => 'Users',
    'edit' => 'Admin.users.edit',
    'store'=> 'Admin.users.store',
    'update'=> 'Admin.users.update'
]);
Route::post('/users/eliminar', [App\Http\Controllers\Admin\UserController::class, 'eliminar'])->middleware('can:admin.users.index')->name('users.eliminar');

Route::post('/users/index/datos', [UsersIndex::class, 'datos'])->middleware('can:admin.users.index')->name('datos');
Route::get('/users/index/roles', [UsersIndex::class, 'devolverRoles'])->middleware('can:admin.users.index')->name('roles.datos');

Route::resource('/contactanos', App\Http\Controllers\ContactanosController::class)->names([
    'index' => 'contactanos.index',
    'store' => 'contactanos.store'
]);
Route::post('/licencia/index/datos', [LicenciasIndex::class, 'datos'])->name('datos1');

Route::post('/Departamento/index/validando', [ValidarSalidasIndex::class, 'validando'])->middleware('can:valida.Salida')->name('validando');
Route::post('/Departamento/ValidaSalida/dato', [ValidaSalidaController::class, 'dato'])->middleware('can:valida.Salida')->name('ValidaSalida.dato');

Route::resource('/departamento/ValidaLicencia', ValidaLicenciaController::class)->names([
    'index'=>'ValidaLicencia',
    'store'=>'ValidaLicencia.store'
]);
Route::post('/departamento/ValidaLicencia/store', [ValidaLicenciaController::class, 'store'])->name('licencias.store');
Route::post('/departamento/ValidaLicencia/datos', [ValidaLicenciaController::class, 'datos'])->name('ValidaLicencia.datos');
Route::post('/departamento/ValidaLicencia/imprimir', [ValidaLicenciaController::class, 'imprimir'])->name('ValidaLicencia.imprimir');