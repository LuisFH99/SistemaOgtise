@extends('adminlte::page')

@section('title', 'URC | ParteDiario')

@section('content_header')
    <h1>Parte Diario Asistencia Docente</h1>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card fondo-cards">
                    <div class="card-body">
                        <div class="row" >
                            {{-- <div class="col-md-8">
                                <label class="form-label">Buscar Docente:</label>
                                <div class="input-group">
                                    <input class="form-control form-control-sidebar" placeholder="Buscar">

                                    <div class="input-group-append">
                                        <button class="btn btn-info">
                                            <i class="fas fa-fw fa-search"></i>
                                        </button>
                                    </div>
                                </div>

                            </div> --}}

                            <div class="col-md-3 col-sm-6 ">

                                <label class="form-label">Facultad:</label>
                                <select id="facultad" name="facultad" class="form-control" tabindex="1">
                                    <option>Seleccione...</option>

                                </select>

                            </div>

                            <div class="col-md-3 col-sm-6 ">
                                <label for="" class="form-label">Departamento Academico:</label>
                                <select class="form-control" id="dptoacademico" name="dptoacademico" tabindex="2">
                                    <option selected>Seleccione...</option>

                                </select>
                            </div>

                            <div class="col-md-3 col-sm-6">
                                <label class="form-label">Fecha de Reporte (*)</label>
                                <input type="date" id="freporte" name="freporte" class="form-control" tabindex="3">
                            </div>

                            <div class="col-md-3 col-sm-6 mt-4 d-flex align-items-center justify-content-center">
                                <a href="{{route('reportegeneral')}}" target="_blank"><button type="button" class="btn btn-outline-primary">Informe General</button></a>  
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card fondo-cards">
                    <div class="card-body">
                        <div>
                            <table class="table table-sm">
                                <thead>
                                  <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">First</th>
                                    <th scope="col">Last</th>
                                    <th scope="col">Handle</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                  </tr>
                                  <tr>

                                    <td colspan="3">DOCENTES CONTRADATOS</td>

                                  </tr>
                                  <tr>
                                    <th scope="row">3</th>
                                    <td>Larry the Bird</td>
                                    <td>@twitter</td>
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
        console.log('Hi!');
    </script>
@stop
