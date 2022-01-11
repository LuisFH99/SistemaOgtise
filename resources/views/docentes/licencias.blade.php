@extends('adminlte::page')

@section('title', 'Licencias')

@section('content_header')
    <h1>Licencias</h1>
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 p-2">
            <div class="card h-100 fondo-cards">
                <div class="card-body">
                    <h2>Crear solicitud de Licencia: {{$user->name}}</h2>
                    <form>
                        <div class="row">
                            <div class="col-md-3">
                                <div>
                                    <p></p>
                                    <label>Solicito Licencia por el siguiente Motivo:</label>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Seleccionar Motivo...
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        @foreach ($Motivos as $Motivo)
                                            <a class="dropdown-item" href='#' onclick='selecMotivo({{ $Motivo -> idMotivoSolicitudes }} );'>
                                                {{$Motivo->motivo}}</a>
                                        @endforeach
                                        
                                    </div>
                                </div>
                                <br>
                                <div id="Nota">
                                    <label id="req1" name="req1">Requisitos</label>
                                    <div id='Nota1'>
                                        <label class="text-danger">Debes Seleccionar un Motivo</label>
                                        <p>*  Especifique</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-6">
                                        <br>
                                        <div>
                                            <label>Justificación</label>
                                            <textarea class="form-control" id="txtareajus" rows="3"></textarea>
                                        </div><br>
                                        <div class="custom-file">
                                            <label>Adjuntar Archivos</label>
                                            <!--<input type="file" class="custom-file-input" name="file" id="file" lang="es" multiple>
                                            <label class="custom-file-label" for="file">Seleccionar Archivo</label>-->
                                            <div action="{{route('licencias.file')}}"  
                                                method="POST"
                                                class="dropzone scroll-3a" 
                                                id="my-awesome-dropzone">
                                                {{-- <div class='fallback'>
                                                    <input name='file' type='file' multiple />
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-7">
                                                <br>
                                                <label>Me ausentare</label><br>
                                                <label>Desde: </label>
                                                <input type="date" id="desde" 
                                                    value="{{$fechaMin}}"
                                                    min="{{$fechaMin}}" max="2050-12-31"><br>
                                                <label>Hasta: </label>
                                                <input type="date" id="hasta" 
                                                    value="{{$fechaMin}}"
                                                    min="{{$fechaMin}}" max="2050-12-31">
                                                <input id="fechs" name="fechs" type="hidden" value="{{$fechaMin.','.$fechaExc}}">
                                            </div> 
                                            <div class="col-5">
                                                <br>
                                                <label>N° de dias: </label>
                                                <span id="dias">1 dia</span><br>
                                                <label>Fecha de Reincorporación:</label>
                                                <span id="reincorporar">Miercoles, 01/12/2021</span>
                                            </div>
                                            <div class="col-12">
                                                <br>
                                                <p class="text-danger">*Debes firmar para autenticar el documento:</p>
                                                <div class="col-12 d-flex justify-content-center">
                                                    <div class="checkbox-custom mr-4">
                                                        <label>
                                                            <input type="checkbox" id="chkDNIE" class="radio" value="1" name="fooby[1][]">
                                                            <b></b>
                                                            <span class="font-weight-light">DNIe</span>
                                                        </label>
                                                    </div>                              
                                                    <div class="checkbox-custom">
                                                        <label>
                                                        <input type="checkbox" id="chkCodigoFirma" class="radio" value="2" name="fooby[1][]">
                                                            <b></b>
                                                            <span class="font-weight-light">Clave de Firma Electrónica</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-12 d-none justify-content-center" id="formclave">
                                                    <div class="col-8">
                                                        <label class="mt-1 text-sm-right ">Ingrese clave</label>
                                                        <div class="input-group">
                                                            <input id="txtCodigoFirma" type="Password" Class="form-control">
                                                            <div class="input-group-append">
                                                                <button style="background-color:#28AECE;border-color:#28AECE" id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword()">
                                                                    <span class="fa fa-eye-slash icon"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                        <br>
                        <button type="button" class="btn btn-primary btn-lg dr d-none" id="btnSolicitar">Solicitar</button>
                        <div class="d-none">
                            <button type="button" class="btn btn-primary btn-lg dr" id="btnSolicitar1">Archivo</button>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-none">
        <a href="#"
            class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" id="btnSolicitar2">
            <i class="fas fa-print fa-sm text-white-50"></i> Imprimir
        </a>
    </div><br><br>
    @livewire('licencias-index',['user' => $user])
</div>
<!-- Modal1 -->
<div class="modal fade bd-example-modal-lg" id="modalCod" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="labelPDF">Licencia pedida el 06/12/21 15:27:12</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="mostrarCod">
                
            </div>
            
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-outline-danger " data-dismiss="modal">Denegar</button>-->
                <button type="button" class="btn btn-outline-success " data-dismiss="modal">Aceptar</button>
            </div>
        </div>
    </div>
</div>  
<!-- Modal2 -->
<div class="modal fade bd-example-modal-lg" id="modalPDF" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="labelPDF">Licencia pedida el 06/12/21 15:27:12</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="mostrarPDF" >
                
            </div>
            
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-outline-danger " data-dismiss="modal">Denegar</button>-->
                <button type="button" class="btn btn-outline-primary " data-dismiss="modal">Aceptar</button>
            </div>
        </div>
    </div>
</div>    
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/css/style.css">
    @livewireStyles
@stop

@section('js')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js" integrity="sha512-oQq8uth41D+gIH/NJvSJvVB85MFk1eWpMK6glnkg6I7EdMqC1XVkW7RxLheXwmFdG03qScCM7gKS/Cx3FYt7Tg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="/js/licencia.js"> </script>
    <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
    @livewireScripts
@stop
