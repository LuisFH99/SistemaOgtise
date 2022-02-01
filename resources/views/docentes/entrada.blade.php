@extends('adminlte::page')

@section('title', 'Asistencia | Entrada')

@section('content_header')
    <h1 id='id'>Registro de Asistencia</h1>
@stop

@section('content')
    <div class="container">

        {{-- {{ $horario }}  --}}

        {{-- {{ $Datos }}
        {{ $estado }}
        {{ $registros}} --}}
        <div class="row">
            <div class="col-lg-6 p-2">
                <div class="card fondo-cards">
                    @if (isset($estado->fk_idestadoasistencias))

                        @switch($estado->fk_idestadoasistencias)
                            @case(1)
                                <div class="card-body">
                                    <h1>Su Asistencia ya fue Registrada</h1>
                                </div>
                            @break
                            @case(2)
                                @if ($Datos->hora > $horario->ini_entrada && $Datos->hora < $horario->fin_entrada)
                                    <div class="card-body">
                                        <h4 class="">Registro de Entrada</h4>
                                        <div class="row">
                                            <div id="divEntrada">
                                                <div class="col-12">
                                                    <input type="hidden" value="{{ $estado->fk_idestadoasistencias }}"
                                                        id="aux">
                                                    <label class="form-label text-black">Hora de Entrada: {{ $Datos->hora }}
                                                    </label>
                                                </div>
                                                <div class="col-12 ">
                                                    <label class="form-label text-black">Camara:</label>
                                                    <div class="row">
                                                        <div class="col-sm-6 col-12 ">
                                                            <video id="video" class="img-responsive" width="200"></video>
                                                        </div>
                                                        <div class="col-sm-6 col-12 ">
                                                            <canvas id="canvas" width="200" class="img-responsive"></canvas>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" name="foto" id="txt">
                                                </div>
                                            </div>
                                            <div class="col-12 text-center">
                                                <label class="form-label">Capturar:</label><i class="fas fa-camera"></i>
                                                <h4 class="titulo_pregunta_1 my-2">¿Con qué deseas firmar?</h4>
                                            </div>
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
                                                            <span>Clave de Firma Electronica</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 d-none justify-content-center" id="formclave">
                                                <div class="col-8">
                                                    <label class="mt-1 text-sm-right ">Ingrese clave</label>
                                                    <div class="input-group">
                                                        <input id="txtCodigoFirma" type="Password" Class="form-control">
                                                        @csrf
                                                        <div class="input-group-append">
                                                            <button style="background-color:#28AECE;border-color:#28AECE"
                                                                id="show_password" class="btn btn-primary" type="button"
                                                                onclick="mostrarPassword()">
                                                                <span class="fa fa-eye-slash icon"></span>
                                                        </div>
                                                        <input type="hidden" name="hh" id="dtohora"
                                                            value="{{ $Datos->hora }}">
                                                        <input type="hidden" name="docente" id="docente"
                                                            value="{{ $Datos->idDocentes }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-none justify-content-center pt-3" id="formbtn">
                                                <button type="button" class="btn btn-primary" id="grabar"> Registar
                                                    Entrada</button>
                                            </div>

                                        </div>
                                    </div>
                                @else
                                    <div class="card-body">
                                        <h1>Fuera de Horario</h1>
                                    </div>
                                @endif
                            @break
                            @case(4)
                                <div class="card-body">
                                    <h1>De Licencia</h1>
                                </div>
                            @break
                            @case(5)
                                <div class="card-body">
                                    <h1>El dia de Hoy es no Laborable</h1>
                                </div>
                            @break
                            @case(6)
                                @if ($Datos->hora > $horario->ini_salida && $Datos->hora < $horario->fin_salida)
                                    <div class="card-body">
                                        <h4 class="">Registro de Salida</h4>
                                        <div class="row">

                                            <!-- <div id="divSalida"> -->
                                            <div class="col-12">
                                                <input type="hidden" value="{{ $estado->fk_idestadoasistencias }}" id="aux">
                                                <label class="form-label text-black">Hora de Salida:
                                                    {{ $Datos->hora }}</label>
                                            </div>
                                            <div class="col-12">
                                                <h6>Detalle de actividad realizada:</h6>
                                                <textarea class="form-control" aria-label="With textarea"
                                                    id="actividad"></textarea>
                                            </div>
                                            <div class="col-12 mt-2">
                                                <h6>Cargar Evidencia <p class="opcional">* La carga de Archivos es
                                                        Opcional
                                                    </p>
                                                </h6>

                                                <div class="custom-file">
                                                    <div action="{{ route('evidencia.file') }}" method="POST"
                                                        class="dropzone scroll-3a" id="my-awesome-dropzone">
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- </div> -->

                                            <div class="col-12 text-center">
                                                <h4 class="titulo_pregunta_1 my-2">¿Con qué deseas firmar?</h4>
                                            </div>
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
                                                            <span>Clave de Firma Electronica</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-12 d-none justify-content-center" id="formclave">
                                                <div class="col-8">
                                                    <label class="mt-1 text-sm-right ">Ingrese clave</label>
                                                    <div class="input-group">
                                                        <input id="txtCodigoFirma" type="Password" Class="form-control">
                                                        @csrf
                                                        <div class="input-group-append">
                                                            <button style="background-color:#28AECE;border-color:#28AECE"
                                                                id="show_password" class="btn btn-primary" type="button"
                                                                onclick="mostrarPassword()">
                                                                <span class="fa fa-eye-slash icon"></span>
                                                        </div>
                                                        <input type="hidden" name="hh" id="dtohora"
                                                            value="{{ $Datos->hora }}">
                                                        <input type="hidden" name="docente" id="docente"
                                                            value="{{ $Datos->idDocentes }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 d-none justify-content-center pt-3" id="formbtn">

                                                <button type="button" class="btn btn-primary" id="Guardar"> Registrar
                                                    Salida</button>
                                                <div class="d-none">
                                                    <button type="button" class="btn btn-primary btn-lg dr"
                                                        id="btnenviar">Archivo</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="card-body">
                                        <h1>Fuera de Horario</h1>
                                    </div>
                                @endif
                            @break
                            @default
                                <div class="card-body">
                                    <h1>No puede Registrar Asistencia...Contactese con el Administrador</h1>
                                </div>

                        @endswitch
                    @else
                        <div class="card-body">
                            <h1>Hoy no registras Asistencia</h1>
                        </div>
                    @endif
                </div>
            </div>

            <div class="col-lg-6 p-2">
                <div class="card fondo-cards">
                    <div class="card-body">
                        <input type="hidden" id="dtofecha" value="{{ $Datos->dia }}">
                        <h4 class="card-title mb-2" id="fecha"></h4>
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
                                        @if (isset($estado->hor_entrada) && $estado->hor_entrada != '00:00:00' )
                                            <td>{{ $estado->hor_entrada }}</td>
                                        @else
                                            <td>-</td>
                                        @endif

                                        @if ( isset($estado->hor_salida) && $estado->hor_salida != '00:00:00' )
                                            <td>{{ $estado->hor_salida }}</td>
                                        @else
                                            <td>-</td>
                                        @endif
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
                                        {{-- <th scope="col">Observacion</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($registros as $registro)
                                        <tr>
                                            <td>{{ $registro->Dia }}</td>
                                            <td>{{ $registro->hor_entrada }}</td>
                                            <td>{{ $registro->hor_salida }}</td>
                                            {{-- <td>{{ $registro->observacion }}</td> --}}
                                        </tr>

                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Reporte de Asistencias mensual --}}
            <div class="col-12 p-2">
                <div class="card">
                    <div class="card-body">
                        <h4><strong>Mis Registros de Asistencia Mensual:</strong></h4>
                        <div class="mb-2 row">
                            <label class="col-sm-1 col-form-label d-flex justify-content-end">MES:</label>
                            <div class="col-sm-4 d-flex justify-content-start">
                                <select id="meses" class="custom-select">
                                    <option value="1">Enero</option>
                                    <option value="2">Febrero</option>
                                    <option value="3">Marzo</option>
                                    <option value="4">Abril</option>
                                    <option value="5">Mayo</option>
                                    <option value="6">Junio</option>
                                    <option value="7">Julio</option>
                                    <option value="8">Agosto</option>
                                    <option value="9">Setiembre</option>
                                    <option value="10">Octubre</option>
                                    <option value="11">Noviembre</option>
                                    <option value="12">Diciembre</option>
                                </select>
                            </div>
                            <label class="col-sm-1 col-form-label d-flex justify-content-end">AÑO:</label>
                            <div class="col-lg-2 col-md-2  col-sm-4   d-flex justify-content-start">
                                <select id="selectyyyy" class="custom-select">
                                </select>
                            </div>
                        </div>

                        <div class=" table-responsive">
                            <table class="table table-sm  table-bordered" id="table">
                                <thead class="fondo-table">
                                    <!-- <tr>
                                                                                                                            <th>MI</th>
                                                                                                                            <th>JU</th>
                                                                                                                            <th>VI</th>
                                                                                                                            <th>SA</th>
                                                                                                                            <th>DO</th>
                                                                                                                            <th>LU</th>
                                                                                                                            <th>MA</th>
                                                                                                                            <th>MI</th>
                                                                                                                            <th>JU</th>
                                                                                                                            <th>VI</th>
                                                                                                                            <th>SA</th>
                                                                                                                            <th>DO</th>
                                                                                                                            <th>LU</th>
                                                                                                                            <th>MA</th>
                                                                                                                            <th>MI</th>
                                                                                                                            <th>JU</th>
                                                                                                                            <th>VI</th>
                                                                                                                            <th>SA</th>
                                                                                                                            <th>DO</th>
                                                                                                                            <th>LU</th>
                                                                                                                            <th>MA</th>
                                                                                                                            <th>MI</th>
                                                                                                                            <th>JU</th>
                                                                                                                            <th>VI</th>
                                                                                                                            <th>SA</th>
                                                                                                                            <th>DO</th>
                                                                                                                            <th>LU</th>
                                                                                                                            <th>MA</th>
                                                                                                                            <th>MI</th>
                                                                                                                            <th>JU</th>
                                                                                                                            <th>VI</th>
                                                                                                                        </tr> -->
                                </thead>
                                <tbody>
                                    <tr class="bg-tr">

                                    </tr>
                                    <tr id="Aux">

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
                        <h5 id="fechreg"></h5>
                        <div class="row">
                            <div class="col-6">
                                <h6 id="entrada"></h6>
                                <h6>Captura de Imagen</h6>
                                <img id="foto" width="180">
                            </div>
                            <div class="col-6">
                                <h6 id="salida"></h6>
                                <h6>Detalle de Actividad</h6>
                                <h6 id="informe"></h6>
                            </div>
                            <div class="col-12 mt-2">
                                <h6 id="documentos"> </h6>
                            </div>
                            <div class="col-12">
                                <h6 id="observacion"> </h6>
                            </div>
                            <div class="col-12">
                                <h6 id="tkentrada"> </h6>
                                <h6 id="tksalida"> </h6>

                            </div>
                        </div>


                    </div>
                    <div class="container" id="Jusficacion">
                        <h4>Aqui justificaras una falta</h4>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
                    {{-- <button type="button" class="btn btn-primary">Guardar</button> --}}
                </div>
            </div>
        </div>
    </div>

    <!-- Fin Formato Modal -->

@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css"
        integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="/css/style.css">

@stop

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"
        integrity="sha512-oQq8uth41D+gIH/NJvSJvVB85MFk1eWpMK6glnkg6I7EdMqC1XVkW7RxLheXwmFdG03qScCM7gKS/Cx3FYt7Tg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="/js/asistencia.js"></script>
    

@stop
