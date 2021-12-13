@extends('adminlte::page')

@section('title', 'Asistencia | Salida')

@section('content_header')
<h1>Registro de Asistencia</h1>
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="card fondo-cards">
                <div class="card-body">
                    <h4>Registro de Salida</h4>
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label text-black">Hora de Salida: 18:04:33</label>
                        </div>
                        <div class="col-12">
                            <h6>Detalle de actividad realizada:</h6>
                            <textarea class="form-control" aria-label="With textarea"></textarea>
                        </div>
                        <div class="col-12 mt-2">
                            <h6>Cargar Evidencia <p class="opcional">* La carga de Archivos es Opcional</p> </h6>
                            
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Cargar Archivo</label>
                            </div>
                        </div>
                        <div class="col-12 d-flex justify-content-center mt-2">
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
                                <button type="button" class="btn btn-primary" id="grabar"> Registrar Salida</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
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
                                    <td>18:04:33</td>
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
                            <select class="form-select " >
                                <option value="1">Enero</option>
                                <option value="2">Febrero</option>
                                <option value="3">Marzo</option>
                                <option value="4" selected >Diciembre</option>
                              </select>
                        </div>
                        <label class="col-sm-1 col-form-label d-flex justify-content-end">AÑO:</label>
                        <div class="col-sm-4 d-flex justify-content-start">
                            <select class="form-select" >
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
                                <td><img src="/vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                <td><img src="/vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                <td><img src="/vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                <td><img src="/vendor/adminlte/dist/img/falto.svg" alt=""></td>
                                <td><img src="/vendor/adminlte/dist/img/nd.svg" alt=""></td>
                                <td><img src="/vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                <td><img src="/vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                <td><img src="/vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                <td><img src="/vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                <td><img src="/vendor/adminlte/dist/img/justificado.svg" alt=""></td>
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
@stop

@section('css')
<link rel="stylesheet" href="/css/style.css">
@stop

@section('js')
<script>
    $(document).ready(function(){
        $("#grabar").click(function(){
            alert("Hola Jquery esta funcionando ");
        });
    });
</script>
@stop