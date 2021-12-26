@extends('adminlte::page')

@section('title', 'ValidaSalida')

@section('content_header')
    <h1>Validar Salidas</h1>
@stop

@section('content')
<div class="container">
    @livewire('validar-salidas-index',['user' => $user])
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
    <script> console.log('Hi!');
    let idsali=0;
    $(function() {
        $("#btnAceptar").click(function() {
            let Firma=$("#txtCodigoFirma").val();
            if(validarEntradas()){
                $.ajax({
                    url: '/Departamento/ValidaSalida/dato',
                    method: 'POST',
                    data: {
                        _token: $('input[name="_token"]').val(),
                        dt: Firma
                    }
                }).done(function(msg) {
                    if (msg === '1') {
                        let justi=$("#txtareaj").val();
                        $.ajax({
                            url: '/departamento/ValidaSalida',
                            method: 'POST',
                            data: {
                                _token: $('input[name="_token"]').val(),
                                Justif: justi,
                                idsal: idsali,
                            }
                        }).done(function(msg) {
                            Swal.fire(
                                'Excelente!',
                                'Ha validado la Salida del Docente de manera exitosa!',
                                'success'
                            )
                            $("#modal1").modal('hide');
                            location.reload();
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
            }
        });
    });
    function validarEntradas() {
        let bdr = false;
        if ($('#txtareaj').val() === '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Debes escribir una Observación para validar la salida!'
            })
            $("#txtareaj").focus();
        } else {
            if ($('#chkCodigoFirma').is(":checked")) {
                if ($('#txtCodigoFirma').val() != '') {
                    bdr = true;
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Debe escribir la clave para validar la salida'
                    })
                    $("#txtCodigoFirma").focus();
                }
            } else {
                if ($('#chkDNIE').is(":checked")) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'No cuentas con el software instalado'
                    })
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Debe elegir una forma de Validacion para su firma'
                    })
                }
                $("#chkCodigoFirma").focus();
            }
        }
        return bdr;
    }
    function selecId(id){
        //document.getElementById('exampleModalLabel').innerHTML=""+nombre;
        idsali=id;
        $.ajax({
            url: '/Departamento/index/validando',
            method: 'POST',
            data: {
                _token: $('input[name="_token"]').val(),
                idSalida: id,
            }
        }).done(function(msg) {
            
            $("#nombret").html('Docente: '+msg.Salida.apellPat+' '+msg.Salida.apellMat+' '+msg.Salida.nombres);
            $("#fecha").html(formatoFecha(msg.Salida.fecha)+" - "+msg.Salida.hor_salida);
            $("#justificacion").html(msg.Salida.informe);
            
            let ArrayE=msg.evi;
            let mj="";
            ArrayE.forEach(function(element) {
                mj=mj+"<a href='#'  class='text-secondary'" 
                     +"onclick='selecEvi("+element.idEvidencias+",\""+element.docs+"\")'><i class='far fa-file-pdf'>"
                        +"</i> Reporte "+numAlet(element.idEvidencias)+ "</a><br>";
            });
            $("#archivos").html(mj);
            $("#modal1").modal('show');
        }).fail(function(msg) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Algo salio mal!'
            })
        });
    }
    function selecEvi(num,dir){
        let numl=(num<10)?'0'+num:''+num;
        $("#titVerArchivos").html("Reporte N° "+numl);
        $("#verArchivos").html("<embed src='"+dir+"' frameborder='0' width='100%' height='400px'>");
        $("#modal2").modal('show');
    }
    function mostrarPassword() {
        var cambio = document.getElementById("txtCodigoFirma");
        if (cambio.type == "password") {
            cambio.type = "text";
            $('.icon').removeClass('fa fa-eye-slash').addClass('fa fa-eye');
        } else {
            cambio.type = "password";
            $('.icon').removeClass('fa fa-eye').addClass('fa fa-eye-slash');
        }
    }
    function formatoFecha(dato) {
        dato = dato.toString();
        date = new Date(dato);
        const months = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        const days = ["Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado", "Domingo"];
        let fecha = dato.split("-");
        let formatted_date = days[date.getDay()] + ", " + fecha[2] + " de " + months[parseInt(fecha[1]) - 1] + " de " + date.getFullYear();
        return formatted_date;
    }
    function numAlet(num){
        const letra =["Cero","Uno","Dos","Tres","Cuatro","Cinco","Seis","Siete","Ocho","Nueve","Diez"];
        return letra[num];
    }
    $("input:checkbox").on('click', function() {
        // in the handler, 'this' refers to the box clicked on
        var $box = $(this);
        if ($box.is(":checked")) {
            // the name of the box is retrieved using the .attr() method
            // as it is assumed and expected to be immutable
            var group = "input:checkbox[name='" + $box.attr("name") + "']";
            // the checked state of the group/box on the other hand will change
            // and the current value is retrieved using .prop() method
            $(group).prop("checked", false);
            $box.prop("checked", true);
        } else {
            $box.prop("checked", false);
        }
    });
    </script>
    @livewireScripts
@stop