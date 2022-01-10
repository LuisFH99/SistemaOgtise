@extends('adminlte::page')

@section('title', 'URC | ParteDiario')

@section('plugins.Datatables', true)

@section('content_header')
    <h1>Parte Diario Asistencia Docente</h1>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="card fondo-cards">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6">

                                <label class="form-label">Mes:</label>
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
                                @csrf
                            </div>

                            <div class="col-md-6">
                                <label for="" class="form-label">Año:</label>
                                <select id="year" class="form-control">
                                </select>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card fondo-cards">
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-5">
                                <label class="form-label">Fecha de Reporte (*)</label>
                                <input type="date" id="freporte" name="freporte" class="form-control" tabindex="3">
                            </div>

                            <div class="col-md-7 mt-4 d-flex align-items-center justify-content-center">
                                <button type="button" class="btn btn-outline-primary mr-2" id="InfGeneral">Parte Diario</button>
                                <button type="button" class="btn btn-outline-danger" id="InfGeneral">Informe de Faltas</button>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card fondo-cards">
                    <div class="card-body table-responsive">

                        <table id="tableURCT" class="table table-sm shadow-lg">
                            <thead class="text-white">
                                <tr>
                                    <th scope="col">N°</th>
                                    <th scope="col">Apellidos y Nombres</th>
                                    <th scope="col">DNI</th>
                                    <th scope="col">Tipo</th>
                                    <th scope="col">Facultad</th>
                                    <th scope="col">Depatameto Académico</th>
                                    <th scope="col">Reporte</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $num = 1;
                                @endphp
                                @foreach ($docentes as $docente)
                                    <tr>
                                        <td>{{ $num++ }}</td>
                                        <td>{{ $docente->nombres }}</td>
                                        <td>{{ $docente->dni }}</td>
                                        <td>{{ strtoupper(substr($docente->nomcondi, 0, 1) . '-' . substr($docente->nomcat, $docente->nomcat == 'Auxiliar' ? 2 : 0, 1)) . substr($docente->nomdedi, 0, 1) . substr(strstr($docente->nomdedi, ' '), 1, 1) }}
                                        </td>
                                        <td>{{ $docente->nomfac }}</td>
                                        <td>{{ $docente->nomdep }}</td>
                                        <td><i class="far fa-address-book"
                                                onclick="GenerarReporte({{ $docente->iddocentes }})"></i></td>
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>

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
        $(document).ready(function() {

            $('#tableURCT').DataTable();
            selectanio(new Date().getFullYear());
            $("#meses option[value=" + (new Date().getMonth() + 1) + "]").attr("selected", true);

        });


        $('#InfGeneral').on('click', function() {
            //alert("la fecha es :" +$('#freporte').val());
            if ($('#freporte').val().trim() !== '') {
                window.open('/URyC/ParteDiario/general/' + $('#freporte').val(), '_blank');
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Debes Indicar una Fecha para el Reporte',
                });
                $('#freporte').focus();
            }
        });

        //funciones
        function selectanio(dto) {
            for (let i = 0; i < 2; i++) {
                $('#year').append($("<option>", {
                    value: dto - i,
                    text: dto - i
                }));
            }
        }

        function GenerarReporte($id) {
            window.open('/URyC/ParteDiario/reporte/'+ $id+'/'+ $('#meses').val()+'/'+$('#year').val(), '_blank');

        }
    </script>
@stop
