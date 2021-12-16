@extends('adminlte::page')

@section('title', 'Asistencia | Entrada')

@section('content_header')
<h1 id='id'>Registro de Asistencia</h1>
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6 p-2">
            <div class="card h-100 fondo-cards">
                <div class="card-body">
                    <h4 class="">Registro de Entrada</h4>
                    <div class="row">
                        @if($var==1)
                        <div id="divEntrada">
                            <div class="col-12">
                                <input type="hidden" value="{{ $var }}" id="aux">
                                <label class="form-label text-black">Hora de Entrada: 07:04:33 </label>
                            </div>
                            <div class="col-12">
                                <label class="form-label text-black">Camara:</label>
                                <div class="row">
                                    <div class="col-sm-6 col-12">
                                        <video id="video" class="img-responsive" width="200"></video>
                                    </div>
                                    <div class="col-sm-6 col-12">
                                        <canvas id="canvas" width="200" class="img-responsive"></canvas>
                                    </div>
                                </div>
                                <input type="hidden" name="foto" id="txt">
                                @csrf
                            </div>
                        </div>
                        @else
                        <div id="divSalida">
                            <div class="col-12">
                                <input type="hidden" value="{{ $var }}" id="aux">
                                <label class="form-label text-black">Hora de Salida: 18:04:33</label>
                            </div>
                            <div class="col-12">
                                <h6>Detalle de actividad realizada:</h6>
                                <textarea class="form-control" aria-label="With textarea" id="actividad"></textarea>
                            </div>
                            <div class="col-12 mt-2">
                                <h6>Cargar Evidencia <p class="opcional">* La carga de Archivos es Opcional</p>
                                </h6>

                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Cargar Archivo</label>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="col-12 d-flex justify-content-center">
                            <div class="d-inline-flex my-1">
                                <div class="checkbox-custom mr-4">
                                    <label>

                                        <input type="checkbox" id="chkDNIE">
                                        <b></b>
                                        <span>DNIe</span>
                                    </label>
                                </div>
                                <div class="checkbox-custom">
                                    <label>
                                        <input type="checkbox" id="chkCodigoFirma">
                                        <b></b>
                                        <span>Clave de Firma Electrinica</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-center">
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
                        <div class="col-12 d-flex justify-content-center pt-3">
                            <button type="button" class="btn btn-primary" id="grabar"> Marcar Asistencia</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 p-2">
            <div class="card fondo-cards">
                <div class="card-body">
                    <h4 class="card-title mb-2">Viernes, 03 Diciembre del 2021</h4>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Registro de Entrada:</th>
                                    <th scope="col">Registro de Salida</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>08:01:33</td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card fondo-cards">
                <div class="card-body">
                    <h4 class="card-title mb-2">Ultimas Asistencias</h4>
                    <div class="table-responsive">
                        <table class="table table-sm">
                            <thead>
                                <tr>
                                    <th scope="col">Dia</th>
                                    <th scope="col">Entrada</th>
                                    <th scope="col">Salida</th>
                                    <th scope="col">Observacion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Jueves, 02/12/2021</td>
                                    <td>08:01:33</td>
                                    <td>18:01:33</td>
                                    <td>Ninguna</td>
                                </tr>
                                <tr>
                                    <td>Miercoles, 02/12/2021</td>
                                    <td>08:01:33</td>
                                    <td>18:01:33</td>
                                    <td>Ninguna</td>
                                </tr>
                                <tr>
                                    <td>Martes, 02/12/2021</td>
                                    <td>08:01:33</td>
                                    <td>18:01:33</td>
                                    <td>Ninguna</td>
                                </tr>
                                <tr>
                                    <td>Lunes, 02/12/2021</td>
                                    <td>08:01:33</td>
                                    <td>18:01:33</td>
                                    <td>Ninguna</td>
                                </tr>
                                <tr>
                                    <td>Viernes, 02/12/2021</td>
                                    <td>08:01:33</td>
                                    <td>18:01:33</td>
                                    <td>Ninguna</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 p-2">
            <div class="card">
                <div class="card-body">
                    <h4><strong>Mis Registros de Asistencia Mensual:</strong></h4>
                    <div class="mb-2 row">
                        <label class="col-sm-1 col-form-label d-flex justify-content-end">MES:</label>
                        <div class="col-sm-4 d-flex justify-content-start">
                            <select class="custom-select">
                                <option value="1">Enero</option>
                                <option value="2">Febrero</option>
                                <option value="3">Marzo</option>
                                <option value="4" selected>Diciembre</option>
                            </select>
                        </div>
                        <label class="col-sm-1 col-form-label d-flex justify-content-end">AÑO:</label>
                        <div class="col-lg-2 col-md-2  col-sm-4   d-flex justify-content-start">
                            <select class="custom-select">
                                <option value="1">2021</option>
                                <option value="2">2020</option>
                                <option value="3">2019</option>
                            </select>
                        </div>
                    </div>

                    <div class=" table-responsive">
                        <table class="table table-sm  table-bordered">
                            <thead class="fondo-table">
                                <tr>
                                    <td>MI</td>
                                    <td>JU</td>
                                    <td>VI</td>
                                    <td>SA</td>
                                    <td>DO</td>
                                    <td>LU</td>
                                    <td>MA</td>
                                    <td>MI</td>
                                    <td>JU</td>
                                    <td>VI</td>
                                    <td>SA</td>
                                    <td>DO</td>
                                    <td>LU</td>
                                    <td>MA</td>
                                    <td>MI</td>
                                    <td>JU</td>
                                    <td>VI</td>
                                    <td>SA</td>
                                    <td>DO</td>
                                    <td>LU</td>
                                    <td>MA</td>
                                    <td>MI</td>
                                    <td>JU</td>
                                    <td>VI</td>
                                    <td>SA</td>
                                    <td>DO</td>
                                    <td>LU</td>
                                    <td>MA</td>
                                    <td>MI</td>
                                    <td>JU</td>
                                    <td>VI</td>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="bg-tr">
                                    <td>1</td>
                                    <td>2</td>
                                    <td>3</td>
                                    <td>4</td>
                                    <td>5</td>
                                    <td>6</td>
                                    <td>7</td>
                                    <td>8</td>
                                    <td>9</td>
                                    <td>10</td>
                                    <td>11</td>
                                    <td>12</td>
                                    <td>13</td>
                                    <td>14</td>
                                    <td>15</td>
                                    <td>16</td>
                                    <td>17</td>
                                    <td>18</td>
                                    <td>19</td>
                                    <td>20</td>
                                    <td>21</td>
                                    <td>22</td>
                                    <td>23</td>
                                    <td>24</td>
                                    <td>25</td>
                                    <td>26</td>
                                    <td>27</td>
                                    <td>28</td>
                                    <td>29</td>
                                    <td>30</td>
                                    <td>31</td>
                                </tr>
                                <tr>
                                    <td><img src="/vendor/adminlte/dist/img/asistio.svg" alt="" onclick="AbrirModal('a')"></td>
                                    <td><img src="/vendor/adminlte/dist/img/asistio.svg" alt="" onclick="AbrirModal('a')"></td>
                                    <td><img src="/vendor/adminlte/dist/img/asistio.svg" alt="" onclick="AbrirModal('a')"></td>
                                    <td><img src="/vendor/adminlte/dist/img/falto.svg" alt="" onclick="AbrirModal('f')"></td>
                                    <td><img src="/vendor/adminlte/dist/img/libre.svg" alt=""></td>
                                    <td><img src="/vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                    <td><img src="/vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                    <td><img src="/vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                    <td><img src="/vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                    <td><img src="/vendor/adminlte/dist/img/justificado.svg" alt="" onclick="AbrirModal('j')"></td>
                                    <td><img src="/vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                    <td><img src="/vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                    <td><img src="/vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                    <td><img src="/vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                    <td><img src="/vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                    <td><img src="/vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                    <td><img src="/vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                    <td><img src="/vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                    <td><img src="/vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                    <td><img src="/vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                    <td><img src="/vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                    <td><img src="/vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                    <td><img src="/vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                    <td><img src="/vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                    <td><img src="/vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                    <td><img src="/vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                    <td><img src="/vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                    <td><img src="/vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                    <td><img src="/vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                    <td><img src="/vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                    <td><img src="/vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Formato Modal -->

<div class="modal" tabindex="-1" id="AsisteciaModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" align="center" id="tituloModal">Modal title</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container" id="Asistencia">
                    <h5>Fecha de Registro: 30 de Diciembre del 2021</h5>
                    <div class="row">
                        <div class="col-6">
                            <h6 class="">Hora de Entrada: 07:01:52</h6>
                            <h6>Captura de Imagen</h6>
                            <img src="/vendor/adminlte/dist/img/image.png" width="197" height="197">
                        </div>
                        <div class="col-6">
                            <h6>Hora de Salida: 17:02:52</h6>
                            <h6>Detalle de Actividad</h6>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Nam facere laborum quia doloribus perferendis sed assumenda consectetur rerum quod tempore sit ullam, velit odio ut. Eveniet debitis tempore harum officia?</p>
                        </div>
                        <div class="12">
                            <h6>Codigo de Registro de Entrada: db0fc5bbb7719a014672 </h6>
                            <h6>Codigo de Registro de Salida: 4e613785df62a95961252 </h6>

                        </div>
                    </div>


                </div>
                <div class="container" id="Jusficacion">
                    <h4>Aqui justificaras una falta</h4>

                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                <button type="button" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- Fin Formato Modal -->

@stop

@section('css')

<link rel="stylesheet" href="/css/style.css">

@stop

@section('js')
<script src="/js/asistencia.js"></script>
</script>
@stop