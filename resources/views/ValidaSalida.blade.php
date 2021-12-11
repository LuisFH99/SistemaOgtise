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
                                    <td><a href="#" data-toggle="modal" data-target="#exampleModal"><i class="far fa-eye"></i></a></td>
                                </tr>
                                <tr>
                                    <td>Cesar Manuel Gregorio Davila Paredes</td>
                                    <td>PDE</td>
                                    <td>02/12/2021, 15:27:50</td>
                                    <td>Ninguna</td>
                                    <td><a href="#"><i class="far fa-eye"></i></a></td>
                                </tr>
                                <tr>
                                    <td>Kiko Felix Depaz Celi</td>
                                    <td>PTC</td>
                                    <td>02/12/2021, 15:27:50</td>
                                    <td>Cumplio</td>
                                    <td><a href="#"><i class="far fa-eye"></i></a></td>
                                </tr>
                                <tr>
                                    <td>Ciro Walter Fernandez Rosales</td>
                                    <td>ADE</td>
                                    <td>02/12/2021, 15:27:50</td>
                                    <td>Falta Validar</td>
                                    <td><a href="#"><i class="far fa-eye"></i></a></td>
                                </tr>
                                <tr>
                                    <td>Prudencio celso Hidalgo Camarena</td>
                                    <td>JPTC</td>
                                    <td>02/12/2021, 15:27:50</td>
                                    <td>Ninguna</td>
                                    <td><a href="#"><i class="far fa-eye"></i></a></td>
                                </tr>
                                <tr>
                                    <td>Carlos Barromeo Poma Villafuerte</td>
                                    <td>xTC</td>
                                    <td>02/12/2021, 15:27:50</td>
                                    <td>Ninguna</td>
                                    <td><a href="#"><i class="far fa-eye"></i></a></td>
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
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img class="centrado" src="https://avam.es/wp-content/uploads/2020/01/icono-check.png">
                <center><h1 class="modal-title text-success" id="exampleModalLabel">Envío Exitoso</h1></center>
                <br>
                <div class="col-14 p-2 ">
                    <div class="card fondo-cards">
                        <div class="table-responsive">
                            <table class="table table-sm ">
                                <tbody>
                                    <tr>
                                        <td>Código de solicitud</td>
                                        <td class="dr">y7GAf5dg</td>
                                    </tr>
                                    <tr>
                                        <td>Fecha de envío:</td>
                                        <td class="d">Jueves, 02/12/2021</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                    <center><p class="text-secondary">Te hemos enviado una copia de esta constancia a tu correo electrónico</p></center>
                </div>
            </div>
            <div class="modal-footer">
                <center><button type="button" class="btn btn-outline-success " data-dismiss="modal">Ok</button></center>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/style.css">
@stop

@section('js')
    <script> console.log('Hi!');</script>
@stop