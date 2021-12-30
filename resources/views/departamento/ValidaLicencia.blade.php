@extends('adminlte::page')

@section('title', 'ValidaSalida')

@section('content_header')
    <h1>Validar Licencias</h1>
@stop

@section('content')
<div class="container">
    {{-- @can('valida.licencia') --}}
        @livewire('valida-licencia-index',['user' => $user,'estado'=>'Enviado','bdr'=>0])
    {{-- @endcan --}}
    {{-- @can('valida.licencia1') --}}
        {{-- @livewire('valida-licencia-index',['user' => $user,'estado'=>'Proceso','bdr'=>0]) --}}
    {{-- @endcan --}}
    {{-- @can('valida.licencia2') --}}
        {{-- @livewire('valida-licencia-index',['user' => $user,'estado'=>'Visto Bueno','bdr'=>1]) --}}
    {{-- @endcan --}}
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
            <div class="modal-body" >
                <p id="nombre"></p>
                <div id="verArchivos">
                    <embed src="#" frameborder="0" width="100%" height="400px">
                </div>
                <div class="row">
                    <div class="col-md-5">
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
                    </div>
                    <div class="col-md-6">
                        
                        <div class="col-12 d-flex justify-content-center">
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
                </div>
            </div>
            <div class="modal-footer">
                    <button type="button" id="btnDenied"class="btn btn-outline-danger">Rechazar</button>
                {{-- @can('valida.licencia') --}}
                    <button type="button" id="btnAcepted" class="btn btn-outline-success">Validar</button>
                {{-- @endcan --}}
                {{-- @can('valida.licencia1') --}}
                    {{-- <button type="button" id="btnAceptedDec" class="btn btn-outline-success">Validar</button> --}}
                {{-- @endcan --}}
                {{-- @can('valida.licencia2') --}}
                    {{-- <button type="button" id="btnAceptedURyC" class="btn btn-outline-success">Validar</button> --}}
                {{-- @endcan --}}
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
<script> console.log('Hi!');</script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        let idlic=0;
        $(function() {
            $("#btnAcepted").click(function() {
                AcepDene('Proceso');
            });
            $("#btnDenied").click(function() {
                AcepDene('Denegado');
            });
            $("#btnAceptedDec").click(function() {
                AcepDene('Visto Bueno');
            });
            $("#btnAceptedURyC").click(function() {
                AcepDene('Aprobado');
            });
        });
        function AcepDene(dto){
            let txtCodigoFirma = $('#txtCodigoFirma').val();
            //if (validarEntradas()) {
                $.ajax({
                    url: '/departamento/ValidaLicencia/datos',
                    method: 'POST',
                    data: {
                        _token: $('input[name="_token"]').val(),
                        dt: txtCodigoFirma
                    }
                }).done(function(msg) {
                    if (msg === '1') {
                        $.ajax({
                            url: '/departamento/ValidaLicencia/store',
                            method: 'POST',
                            data: {
                                _token: $('input[name="_token"]').val(),
                                idSol: idlic,
                                dt: dto
                            }
                        }).done(function(msg) {
                            console.log('correcto: ' + msg);
                            Swal.fire({
                                title: (dto==='Denegado')?'Solicitud Denegada':'Solicitud '+dto,
                                icon: (dto==='Denegado')?'warning':'success',
                                confirmButtonText: 'Aceptar!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    location.reload();
                                }
                                
                            })
                            $('#modal2').modal('hide');
                        }).fail(function(msg) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Algo salio mal!'
                            })
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'La contraseña no es Correcta!'
                        })
                    }
                }).fail(function(msg) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Algo salio mal!...'
                    })
                });
            //}
        }
        function selecId(id,dir,fecha, hr, nomb) {
            idlic=id;
            $('#titVerArchivos').html('Licencia pedida el ' +formatoFecha(fecha)+ ' a horas: ' + hr);
            $('#nombre').html('Docente: <b>'+nomb+'</b>');
            $('#verArchivos').html("<embed src='" + dir + "' frameborder='0'" +
                " width='100%' height='350px'>");
            $('#modal2').modal('show');
        }

        function selecEvi(id) {
            console.log(id);
        }
        function formatoFecha(dato) { //2021-12-09
            dato = dato.toString();
            date = new Date(dato);
            const months = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
            const days = ["Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado", "Domingo"];
            let fecha = dato.split("-");
            let formatted_date = days[date.getDay()] + ", " + fecha[2] + " de " + months[parseInt(fecha[1]) - 1] + " de " + date.getFullYear();
            return formatted_date;
        }
    </script>
    @livewireScripts
@stop