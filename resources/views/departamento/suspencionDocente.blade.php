@extends('adminlte::page')

@section('title', 'Suspencion | Docente')

@section('plugins.Datatables', true)

@section('content_header')
    <h1 class="text-center">Modulo de Suspención Docente</h1>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <h4 class="col-md-12">Identificacion de Docente</h4>
                            <div class="col-md-6">
                                <p class="h5"><strong>Docente:</strong> </p>
                                <p class="h5">
                                    {{ $Persona->nombres }}
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="h5"><strong>N° DNI:</strong> </p>
                                <p class="h5">
                                    {{ $Persona->DNI }}
                                </p>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <h4 class="col-md-12">Fechas de Suspención</h4>
                            <form action="{{ route('docentes.generarSuspencion', $Persona->idDocentes) }}" method="post">
                                @csrf
                                @method('put')
                                <div class="row">
                                    <div class="col-md-6">
                                        <p class="h6">Fecha Inicio:</p>
                                        <input class="form-control col-md-10 " name="inicio" type="date" min="{{$Persona->dia}}">
                                    </div>
                                    <div class="col-md-6">
                                        <p class="h6">Fecha Fin:</p>
                                        <input class="form-control col-md-10 " name="fin" type="date" min="{{$Persona->dia}}">
                                    </div>
                                    <div class="col-md-12 mt-3 text-center">
                                        <a href="{{ route('docentes') }}" class="btn btn-secondary mr-2">Cancelar</a>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </div>
                            </form>


                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-center"><strong>Historial de Suspenciones</strong></h5>
                        <div class="table-responsive ">
                            <table class="table table-sm" id="historial">
                                <thead class="text-white">
                                    <tr>
                                        <th scope="col" style="width: 10%; ">N°</th>
                                        <th scope="col" style="width: 20%; ">Desde</th>
                                        <th scope="col" style="width: 20%; ">Hasta</th>
                                        <th scope="col" style="width: 20%; ">Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($allsupenciones))
                                        @php
                                            $num = 1;
                                        @endphp
                                        @foreach ($allsupenciones as $item)
                                            <tr>
                                                <td style="text-align: center;">{{ $num++ }}</td>
                                                <td style="text-align: center;">{{ $item->fech_ini }}</td>
                                                <td style="text-align: center;">{{ $item->fech_fin }}</td>
                                                <td style="text-align: center;">
                                                    <span
                                                        class="badge {{ $item->estado == 1 ? 'bg-success' : 'bg-danger' }}">{{ $item->estado == 1 ? 'Habilitado' : 'Deshabilitado' }}</span>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
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
        $(function() {

            $('#historial').DataTable({
                dom: 'ftp',
                "lengthMenu": [
                    [6],
                    [6]
                ],
                "language": {
                    "zeroRecords": "No hay datos",
                    "search": "Buscar",
                    "paginate": {
                        'next': '>>',
                        'previous': '<<'
                    }
                }
            });


        });
    </script>
@stop
