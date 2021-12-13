@extends('adminlte::page')

@section('title', 'Asistencia')

@section('content_header')
    <h1 id='id'>Registro de Asistencia</h1>
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6 p-2">
            <div class="card h-100 fondo-cards">
                <div class="card-body">
                    <h4 class="">Registro de Entrada</h4>
                    <div class="row">
                        <div class="col-12">
                            <label class="form-label text-black" >Hora de Entrada: 07:04:33</label>
                        </div>
                        <div class="col-12">
                            <label class="form-label text-black" >Camara:</label>
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                <video id="video" class="img-responsive" width="200"></video>
                                </div>
                                <div class="col-lg-6 col-12">
                                <canvas id="canvas" width="200" class="img-responsive"></canvas>
                                </div>
                            </div>
                            <input type="text" name="" id="txt">
                        </div>
                        <div class="col-12">
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
                        <div class="col-8">
                            <label class="mt-1 text-sm-right ">Ingrese clave</label>
                            <div class="input-group">
                                <input id="txtCodigoFirma" type="Password" Class="form-control">
                                <div class="input-group-append">
                                <button style="background-color:#28AECE;border-color:#28AECE" id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword()">
                                <span class="fa fa-eye-slash icon"></span>
                                </div>
                            </div> 
                            <div>
                                <button type="button" class="btn btn-primary" id="grabar"> Marcar Asistencia</button>
                            </div>                       
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 p-2">
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
                    <h4 class="card-title">Mis Registros de Asistencia Mensual:</h4>
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
                                <td><img src="vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                <td><img src="vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                <td><img src="vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                <td><img src="vendor/adminlte/dist/img/falto.svg" alt=""></td>
                                <td><img src="vendor/adminlte/dist/img/nd.svg" alt=""></td>
                                <td><img src="vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                <td><img src="vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                <td><img src="vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                <td><img src="vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                <td><img src="vendor/adminlte/dist/img/justificado.svg" alt=""></td>
                                <td><img src="vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                <td><img src="vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                <td><img src="vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                <td><img src="vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                <td><img src="vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                <td><img src="vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                <td><img src="vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                <td><img src="vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                <td><img src="vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                <td><img src="vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                <td><img src="vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                <td><img src="vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                <td><img src="vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                <td><img src="vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                <td><img src="vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                <td><img src="vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                <td><img src="vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                <td><img src="vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                <td><img src="vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                <td><img src="vendor/adminlte/dist/img/asistio.svg" alt=""></td>
                                <td><img src="vendor/adminlte/dist/img/asistio.svg" alt=""></td>
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
        /* navigator.mediaDevices.getUserMedia({ audio: false, video: true}).then((stream)=>{
        let video = document.getElementById("video");

        video.srcObject = stream;

        video.onloadedmetadata = (ev) => video.play();
        
        }).catch((err)=>console.log(err)); */
        navigator.mediaDevices.getUserMedia({
                            audio: false,
                            video: false
                        }).then((stream) => {
                            if (stream) {
                                let video = document.getElementById('video');
                                video.srcObject = stream;
                                video.onloadedmetadata = (ev) => video.play();
                                var canvas = document.getElementById('canvas');
                                grabar.addEventListener("click", function() {
                                    canvas.getContext('2d').drawImage(video, 0, 0, video.videoWidth, video.videoHeight,
                                        0, 0, 198, 150);
                                    var data = canvas.toDataURL('image/png');
                                    document.getElementById('txt').setAttribute('value', data);
                                    var a = data;
                                    console.log(data);
                                    //document.getElementById('tema').value =  document.getElementById('tem').value;
                                    // document.getElementById('marcadosalida').value = document.getElementById('MSalida').value;

                                });
                            }
                        }).catch((err)=>{
                            console.log(err);
                            grabar.addEventListener("click", function() {
                                    document.getElementById('tema').value =  document.getElementById('tem').value;
                                    // document.getElementById('marcadosalida').value = document.getElementById('MSalida').value;

                                });
                        })



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
    </script>
@stop