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
use App\Http\Livewire\Admin\UsersIndex;
use App\Http\Livewire\LicenciasIndex;
use App\Mail\ContactanosMailable;
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
Route::get('/departamento/ValidaSalida', [ValidaSalidaController::class, 'index'])->name('ValidaSalida');

Route::get('docentes/entrada', [EntradaController::class, 'index'])/*->middleware('can:asistencia.Entrada')*/->name('entrada');
Route::get('docentes/salida', [SalidaController::class, 'index'])/*->middleware('can:asistencia.Salida')*/->name('salida');
Route::post('docentes/entrada/registrar', [EntradaxController::class, 'store'])->name('docentes.entrada.registrar');
Route::post('/docentes/entrada/registrar', [EntradaController::class, 'store'])->name('registrar');
Route::post('/docentes/salida/registrar', [SalidaController::class, 'store'])->name('registrar.salida');


Route::get('/departamento/docentes', [DocentesController::class, 'index'])->name('docentes');
Route::get('/departamento/creardocente', [DocentesController::class, 'create'])->name('creardocente');
Route::post('/departamento/docentes/store',[DocentesController::class,'store'])->name('docentes.store');







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
    'show' => 'licencias.show',
    'store' => 'licencias.store'
]);
Route::post('/docentes/licencias/file', [LicenciasController::class, 'file'])->name('licencias.file');

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