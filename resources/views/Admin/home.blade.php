@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    {{-- <h1>Asistencia Docente</h1> --}}
@stop

@section('content')
    {{-- <p>Quizas algo se nos ocurra xd xd</p> --}}
        {{-- <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Imágenes
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="{{route('Admin.files.index')}}">Ver Imagenes</a>
                <a class="dropdown-item" href="{{route('Admin.files.create')}}">Crear Imagen</a>
            </div>
        </div> --}}
    <br><br>
    <div class="container">
        <div class="card">
            <div class="card-body">
                
                    <center><p class="h1">Bienvenidos al Sistema de Gestion de Asistencia Docente</p></center><br>
                
                <div class="row mx-auto">
                    @can('admin.users.index')
                        <div class="col-md-4">
                            <div class="card border-success mb-3 mb-3 rounded shadow" style="max-width: 18rem;">
                                <div class="card-header bg-transparent border-success"><center><b>Usuarios</b></center></div>
                                <div class="card-body">
                                <h5 class="card-title"><b>Gestión de Usuarios</b></h5>
                                <p class="card-text text-justify">Puede agregar, editar usuarios, asi como la Gestión de roles de cada usuario.</p>
                                </div>
                                <div class="card-footer"><center><a href="/users" class="text-success"><b>Click Aqui</b></a></center></div>
                            </div>
                        </div>
                    @endcan
                    @can('gestion.docente')
                        <div class="col-md-4">
                            <div class="card border-warning mb-3 mb-3 rounded shadow" style="max-width: 18rem;">
                                <div class="card-header bg-transparent border-warning"><center><b>Docentes</b></center></div>
                                <div class="card-body">
                                <h5 class="card-title"><b>Gestión de Docentes</b></h5>
                                <p class="card-text text-justify">Puede agregar, editar docentes, asi como la carga laboral, designación de cargos, suspensiones, etc.</p>
                                </div>
                                <div class="card-footer"><center><a href="/departamento/docentes" class="text-warning"><b>Click Aqui</b></a></center></div>
                            </div>
                        </div>
                    @endcan
                    @can('asistencia.Entrada')
                        <div class="col-md-4">
                            <div class="card border-primary mb-3 mb-3 rounded shadow" style="max-width: 18rem;">
                                <div class="card-header bg-transparent border-primary"><center><b>Asistencia</b></center></div>
                                <div class="card-body">
                                <h5 class="card-title"><b>Entradas y Salidas</b></h5>
                                <p class="card-text text-justify">Puede firmar su asistencia, tanto de entrada como de salida, es muy importante que lo realices.</p>
                                </div>
                                <div class="card-footer"><center><a href="/docentes/entrada" class="text-primary"><b>Click Aqui</b></a></center></div>
                            </div>
                        </div>
                    @endcan
                    @can('licencia')
                        <div class="col-md-4">
                            <div class="card border-info mb-3 mb-3 rounded shadow" style="max-width: 18rem;">
                                <div class="card-header bg-transparent border-info"><center><b>Licencias</b></center></div>
                                <div class="card-body">
                                <h5 class="card-title"><b>Gestion de Licencias</b></h5>
                                <p class="card-text text-justify">Puede solicitar su licencia y visualizar el estado de todas tus licencias solicitadas.</p>
                                </div>
                                <div class="card-footer"><center><a href="/docentes/licencias" class="text-info"><b>Click Aqui</b></a></center></div>
                            </div>
                        </div>
                    @endcan
                    @can('valida.Salida')
                        <div class="col-md-4">
                            <div class="card border-secondary mb-3 mb-3 rounded shadow" style="max-width: 18rem;">
                                <div class="card-header bg-transparent border-secondary"><center><b>Validar Asistencia</b></center></div>
                                <div class="card-body">
                                <h5 class="card-title"><b>Validar Salidas</b></h5>
                                <p class="card-text text-justify">Puedes validar la salida de todos los docentes pertenecientes a su direccion de departamento.</p>
                                </div>
                                <div class="card-footer"><center><a href="/departamento/ValidaSalida" class="text-secondary"><b>Click Aqui</b></a></center></div>
                            </div>
                        </div>
                    @endcan
                    @can('valida.licencia')
                        <div class="col-md-4">
                            <div class="card border-danger mb-3 mb-3 rounded shadow" style="max-width: 18rem;">
                                <div class="card-header bg-transparent border-danger"><center><b>Validar Licencias</b></center></div>
                                <div class="card-body">
                                <h5 class="card-title"><b>Validar Licencias</b></h5>
                                <p class="card-text text-justify">Puede validar las solicitudes de licencia de todos los docentes a su cargo.</p>
                                </div>
                                <div class="card-footer"><center><a href="/departamento/ValidaLicencia" class="text-danger"><b>Click Aqui</b></a></center></div>
                            </div>
                        </div>
                    @endcan
                    @can('reportes.parteDiario')
                        <div class="col-md-4">
                            <div class="card border-dark mb-3 mb-3 rounded shadow" style="max-width: 18rem;">
                                <div class="card-header bg-transparent border-dark"><center><b>Horario</b></center></div>
                                <div class="card-body">
                                <h5 class="card-title"><b>Cambio de Horario</b></h5>
                                <p class="card-text text-justify">Puede cambiar el horario de asistencia.</p>
                                </div>
                                <div class="card-footer"><center><a href="/departamento/ValidaLicencia" class="text-dark"><b>Click Aqui</b></a></center></div>
                            </div>
                        </div>
                    @endcan
                    @can('reportes.parteDiario')
                        <div class="col-md-4">
                            <div class="card border-warning mb-3 mb-3 rounded shadow" style="max-width: 18rem;">
                                <div class="card-header bg-transparent border-warning"><center><b>Parte diario</b></center></div>
                                <div class="card-body">
                                <h5 class="card-title"><b>Reportes de Asistencia</b></h5>
                                <p class="card-text text-justify">Puede visualizar y/o descargar los reportes de asistencia.</p>
                                </div>
                                <div class="card-footer"><center><a href="/departamento/ValidaLicencia" class="text-warning"><b>Click Aqui</b></a></center></div>
                            </div>
                        </div>
                    @endcan
                    
                        <div class="col-md-4">
                            <div class="card border-success mb-3 mb-3 rounded shadow" style="max-width: 18rem;">
                                <div class="card-header bg-transparent border-success"><center><b>Perfil</b></center></div>
                                <div class="card-body">
                                <h5 class="card-title"><b>Perfil de Usuario</b></h5>
                                <p class="card-text text-justify">Puede cambiar su contraseña cuando lo desee.</p>
                                </div>
                                <div class="card-footer"><center><a href="/departamento/ValidaLicencia" class="text-success"><b>Click Aqui</b></a></center></div>
                            </div>
                        </div>
                    
                </div>
            </div>
            
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/style.css">
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
