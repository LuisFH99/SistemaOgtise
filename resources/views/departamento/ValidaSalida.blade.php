@extends('adminlte::page')

@section('title', 'ValidaSalida')

@section('content_header')
    <h1>Validar Salidas</h1>
@stop

@section('content')
<div class="container">
    @livewire('validar-salidas-index',['sdate'=>$fecha])
</div> 

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" id="modal1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="nombret"></h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-12 p-2 ">
                    <div class="card fondo-cards">
                        <div class="table-responsive">
                            <table class="table table-sm">
                                <tbody>
                                    <tr>
                                        <td>Fecha y Hora de Salida</td>
                                        <td class="dr" id="fecha">Lunes, 06 de diciembre de 2021</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>   
                            <label for="">Justificación</label><br>
                            <div class="col-md-10">
                                <p id="justificacion">Capacitación</p><br>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="">Documentos adjuntos:</label><br>
                                    <div class="col-md-14" id="archivos">
                                        <a href="#"  class="text-secondary" 
                                        onclick="selecEvi('https://www.fdi.ucm.es/profesor/jpavon/poo/01HolaMundo.pdf')">
                                        <i class="far fa-file-pdf"></i>Reporte Uno</a><br>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Observación:</label><br>
                                    <textarea class="form-control" id="txtareaj" rows="3"></textarea>
                                </div>
                                <div class="col-md-5"><br><br>
                                    <p class="text-danger">*Debes firmar para autenticar el documento:</p>
                                </div>
                                <div class="col-md-6">
                                    <br>
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
                                            <div class="input-group ">
                                                <input id="txtCodigoFirma" type="Password" Class="form-control">
                                                <div class="input-group-append">
                                                    <button style="background-color:#28AECE;border-color:#28AECE" id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword()">
                                                        <span class="fa fa-eye-slash icon"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div><br>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-success" id="btnAceptar" data-dismiss="modal">Validar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal2 -->
<div class="modal fade bd-example-modal-lg1" id="modal2" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titVerArchivos"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="verArchivos">
                <embed src="#" frameborder="0" width="100%" height="400px">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary">Aceptar</button>
            </div>
        </div>
    </div>
</div> 
@stop

@section('css')
    <link rel="stylesheet" href="/css/style.css">
    @livewireStyles
@stop

@section('js')
    <script src="/js/ValidaSalida.js">
    </script>
    @livewireScripts
@stop