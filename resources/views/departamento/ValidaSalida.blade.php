@extends('adminlte::page')

@section('title', 'ValidaSalida')

@section('content_header')
    <h1>Validar Salidas</h1>
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-14 p-2 anc">
            <div class="card fondo-cards">
                <div class="col-14 card-body ">
                    <h2>Salidas Registradas:</h2>
                    <div class="table-responsive">
                        <table class="table table-sm" id="idtableSalidas">
                            <thead>
                                <tr>
                                    <th scope="col">Docente</th>
                                    <th scope="col">Tipo</th>
                                    <th scope="col">Hora de Salida</th>
                                    <th scope="col">Observación</th>
                                    <th scope="col">Ver</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Miriam Lucero Gonzales de la Puerta</td>
                                    <td>XTC</td>
                                    <td>02/12/2021, 15:27:50</td>
                                    <td>Falta validar</td>
                                    <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-lg" onclick="selecNombre('Miriam')"><i class="far fa-eye"></i></a></td>
                                </tr>
                                <tr>
                                    <td>Cesar Manuel Gregorio Davila Paredes</td>
                                    <td>PDE</td>
                                    <td>02/12/2021, 15:27:50</td>
                                    <td>Ninguna</td>
                                    <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-lg" onclick="selecNombre('Cesar')"><i class="far fa-eye"></i></a></td>
                                </tr>
                                <tr>
                                    <td>Kiko Felix Depaz Celi</td>
                                    <td>PTC</td>
                                    <td>02/12/2021, 15:27:50</td>
                                    <td>Cumplio</td>
                                    <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-lg" onclick="selecNombre('Kiko')"><i class="far fa-eye"></i></a></td>
                                </tr>
                                <tr>
                                    <td>Ciro Walter Fernandez Rosales</td>
                                    <td>ADE</td>
                                    <td>02/12/2021, 15:27:50</td>
                                    <td>Falta Validar</td>
                                    <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-lg" onclick="selecNombre('Ciro')"><i class="far fa-eye"></i></a></td>
                                </tr>
                                <tr>
                                    <td>Prudencio celso Hidalgo Camarena</td>
                                    <td>JPTC</td>
                                    <td>02/12/2021, 15:27:50</td>
                                    <td>Ninguna</td>
                                    <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-lg" onclick="selecNombre('Prudencio')"><i class="far fa-eye"></i></a></td>
                                </tr>
                                <tr>
                                    <td>Carlos Barromeo Poma Villafuerte</td>
                                    <td>xTC</td>
                                    <td>02/12/2021, 15:27:50</td>
                                    <td>Ninguna</td>
                                    <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-lg" onclick="selecNombre('Carlos')"><i class="far fa-eye"></i></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 

<!-- Modal -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="exampleModalLabel"></h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-14 p-2 ">
                    <div class="card fondo-cards">
                        <div class="table-responsive">
                            <table class="table table-sm ">
                                <tbody>
                                    <tr>
                                        <td>Fecha y Hora de Salida</td>
                                        <td class="dr">Lunes, 06 de diciembre de 2021</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>   
                            <label for="">Justificación</label><br>
                            <div class="col-md-10">
                                <p id="justificacion">Capacitación realizada con exito desde las 15:00 hasta las  18:15 del dia de hoy</p><br>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                    <label for="">Documentos adjuntos:</label><br>
                                    <div class="col-md-14" id="archivos">
                                        <a href="#"  class="text-secondary" data-toggle="modal" data-target=".bd-example-modal-lg1" onclick="selecNombre('Reporte Uno')"><i class="far fa-file-pdf"></i>Reporte Uno</a><br>
                                        <a href="#"  class="text-secondary" data-toggle="modal" data-target=".bd-example-modal-lg1"onclick="selecNombre('Reporte Dos')"><i class="far fa-file-excel"></i>reporte dos</a>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Observación:</label><br>
                                    <textarea class="form-control" id="txtarea" rows="3"></textarea>
                                </div>
                            </div>
                        
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-success " data-dismiss="modal">Validar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal2 -->
<div class="modal fade bd-example-modal-lg1" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!--<div class="col-14 p-2 ">
                    <div class="card fondo-cards">
                        <div class="table-responsive">
                            <table class="table table-sm ">
                                <tbody>
                                    <tr>
                                        <td>Fecha y Hora de Petición</td>
                                        <td class="dr">Lunes, 06 de diciembre de 2021</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>-->
                        <embed src="https://www.fdi.ucm.es/profesor/jpavon/poo/01HolaMundo.pdf" frameborder="0" width="100%" height="400px">
                    <!--</div>
                </div>-->
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
    <link rel="stylesheet" href="/css/style.css">
@stop

@section('js')
    <script> console.log('Hi!');
    function selecNombre(nombre){
        document.getElementById('exampleModalLabel').innerHTML=""+nombre;
    }
    function selecNombre(nombre){
        document.getElementById('exampleModalLabel2').innerHTML=""+nombre;
    }
    </script>
@stop