@extends('adminlte::page')

@section('title', 'Inicio')

@section('plugins.Datatables', true)

@section('content_header')
    <h1>Asignar Dias Laborables</h1>
@stop

@section('content')
    
    <div class="container">
        @if($suspendido==0)
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <p class="h5">Nombre:</p>
                        <p class="form-control">
                            {{ $Persona->apellPat . ' ' . $Persona->apellMat . ' ' . $Persona->nombres }}
                        </p>

                        <h5>Listado de dias de la semana:</h5>
                        {!! Form::model($DetSemanas, ['url' => '/departamento/docentes/updateSemana/' . $Persona->idDocentes . '', 'method' => 'put']) !!}


                        @foreach ($Semanas as $Semana)
                            <label class="form-check-label mr-3">
                                <input type="checkbox" name='cbox{{ $Semana->idSemanas }}'
                                    id='cbox{{ $Semana->idSemanas }}' value="{{ $Semana->idSemanas }}">
                                {{ $Semana->dia }}
                            </label>
                        @endforeach
                        <br>
                        {!! Form::submit('Guardar Cambios', ['class' => 'btn btn-primary mt-2']) !!}
                        {!! Form::close() !!}


                        {!! Form::open(['url' => '/departamento/docentes/updatecargos/' . $Persona->idDocentes . '', 'method' => 'put']) !!}
                        <br>
                            <input name="id" id="id" type="hidden" value="{{ isset($cargoDocente->idcargos) ? $cargoDocente->idcargos : '0' }}">
                        <p class="h5">Cargo Designado:</p>
                        <div class="row">
                            <input class="form-control col-md-10 cargo" type="text"
                                value="{{ isset($cargoDocente->cargo) ? $cargoDocente->cargo : 'Ningún cargo designado' }}"
                                readonly><span class="col-md-2"><i class="fas fa-backspace"
                                    onclick="Borrar()"></i></span>
                        </div>

                        <div class="row mt-2">
                            <div class="col-md-6">
                                <p class="h6">Fecha Inicio:</p>
                                <input class="form-control col-md-10 " name="inicio" type="date"
                                    value="{{ isset($cargoDocente->fech_ini) ? $cargoDocente->fech_ini : '' }}">
                            </div>
                            <div class="col-md-6">
                                <p class="h6">Fecha Fin:</p>
                                <input class="form-control col-md-10 " name="fin" type="date"
                                    value="{{ isset($cargoDocente->fech_fin) ? $cargoDocente->fech_fin : '' }}" min="{{$allcargos->dia}}">

                            </div>

                        </div>
                        {!! Form::submit('Actualizar Cargo', ['class' => 'btn btn-primary mt-2']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5>Gestion Cargo Docentes</h5>
                        <div class="table-responsive ">
                            <table class="table table-sm" id="cargos">
                                <thead class="text-white">
                                    <tr>
                                        <th scope="col" style="width: 10%; ">N°</th>
                                        <th scope="col" style="width: 40%; ">Cargo</th>
                                        <th scope="col" style="width: 20%; ">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($cargos))
                                        @php
                                            $num = 1;
                                        @endphp
                                        @foreach ($cargos as $cargo)
                                            <tr>
                                                <td style="text-align: center;">{{ $num++ }}</td>
                                                <td>{{ $cargo->cargo }}</td>
                                                <td style="text-align: center;">
                                                    <span><i class="fas fa-clipboard-check mr-3"
                                                            onclick="DesignarCargo({{ $cargo->idCargos }},'{{ $cargo->cargo }}')"></i></span>
                                                    <span><i class="fas fa-trash-alt "
                                                            onclick="EliminarCargo({{ $cargo->idCargos }})"></i></span>
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
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-center"><strong>Lista de Cargos</strong></h5>
                        <div class="table-responsive ">
                            <table class="table table-sm" id="historial">
                                <thead class="text-white">
                                    <tr>
                                        <th scope="col" style="width: 10%; ">N°</th>
                                        <th scope="col" style="width: 40%; ">Cargos-Suspenciones</th>
                                        <th scope="col" style="width: 20%; ">Desde</th>
                                        <th scope="col" style="width: 20%; ">Hasta</th>
                                        <th scope="col" style="width: 20%; ">Estado</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (isset($cargos))
                                        @php
                                            $num = 1;
                                        @endphp
                                        @foreach ($allcargos as $item)
                                            <tr>
                                                <td style="text-align: center;">{{ $num++ }}</td>
                                                <td>{{ $item->cargo }}</td>
                                                <td style="text-align: center;">{{$item->fech_ini}}</td>
                                                <td style="text-align: center;">{{$item->fech_fin}}</td>
                                                <td style="text-align: center;">
                                                    <span class="badge {{($item->estado ==1 )?'bg-success':'bg-danger'}}">{{($item->estado ==1 )?'Habilitado':'Deshabilitado'}}</span>
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
        @else
        <div class="row justify-content-center ">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-center"> <strong>El docentes esta suspendido</strong></h5>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    </div>

    <div class="modal" id="modalCrear" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Crear Nuevo Cargo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label class="form-label">Nombre de Cargo:</label>
                    <input type="text" class="form-control" id="newcargo" value="" autocomplete="off">
                    <p id="msj"></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="save">Guardar</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
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
    <script>
        $(function() {
            marcarSemana();
            $('#cargos').DataTable({
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

            $('#cargos_filter').append(
                '<button type="button" class="btn btn-info ml-5 mr-2" id="AddCargo"><i class="fas fa-folder-plus"></i></button>'
            );

            $('#AddCargo').on("click", function() {
                $('#modalCrear').modal('show');
            });

            $("#save").on("click", function() {
                // alert($("#newcargo").val());
                if ($("#newcargo").val().trim() == 0) {
                    $(".alert-danger").remove();
                    $(".alert-warning").remove();
                    $(".modal-body").append(
                        '<div class="alert alert-danger" role="alert"><i class="fas fa-exclamation-circle"></i>&nbsp;&nbsp;Campo Vacio</div>'
                    );
                    //$("#msj").text('DatoVacio');
                } else {
                    $.ajax({
                        url: '/departamento/docentes/cargo/' + $("#newcargo").val().trim(),
                        method: 'GET'
                    }).done(function(res) {
                        if (res == 1) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Nuevo cargo creado con exito',
                                showConfirmButton: false,
                                timer: 1000
                            });
                            $('#modalCrear').modal('hide');
                            location.reload();
                        } else {
                            $(".alert-warning").remove();
                            $(".alert-danger").remove();
                            $(".modal-body").append(
                                '<div class="alert alert-warning" role="alert"><i class="fas fa-exclamation-circle"></i>&nbsp;&nbsp;El cargo ya esta Registrado</div>'
                            );
                        }
                    }).fail(function() {
                        alert("error");
                    });
                }
            })
        });

        //funciones
        function marcarSemana() {
            let datos = "{{ $msg }}";
            let array = datos.split(',');
            array.shift();
            array.forEach(element => {
                for (let i = 1; i <= 5; i++) {
                    let dt = $("#cbox" + i).val();
                    // console.log(element + "-" + dt);
                    if (dt === element) {
                        $("#cbox" + i).prop("checked", true);
                    }
                }
            });
        }

        function DesignarCargo(id, dto) {
            $(".cargo").val(dto);
            $("#id").val(id);
        }

        function Borrar() {
            $(".cargo").val("Ningún cargo designado");
            $("#id").val(0);
        }

        function EliminarCargo(id) {
            Swal.fire({
                title: 'El cargo se Eliminara de forma Permanente',
                text: "No se podrá revertir esta accion!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Si, Eliminar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/departamento/docentes/cargo/eliminar',
                        method: 'POST',
                        data: {
                            _token: $('input[name="_token"]').val(),
                            idcargo: id,
                            ev: 1
                        }
                    }).done(function(res) {
                        //console.log(res)
                        if (res == 1) {
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'El registro de se eliminó correctamente',
                                showConfirmButton: false,
                                timer: 1000
                            });
                            location.reload();
                        } else {
                            Swal.fire({
                                title: 'El cargo Tiene Datos Relacionados',
                                text: "Se eliminara todos esos datos, ¿Desea Continuar?",
                                icon: 'warning',
                                showCancelButton: true,
                                confirmButtonColor: '#d33',
                                cancelButtonColor: '#3085d6',
                                confirmButtonText: 'Si, Eliminar!'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    $.ajax({
                                        url: '/departamento/docentes/cargo/eliminar',
                                        method: 'POST',
                                        data: {
                                            _token: $('input[name="_token"]').val(),
                                            idcargo: id,
                                            ev: 2
                                        }
                                    }).done(function(res) {
                                        //console.log(res)
                                        if (res == 1) {
                                            Swal.fire({
                                                position: 'center',
                                                icon: 'success',
                                                title: 'El registro de se eliminó correctamente',
                                                showConfirmButton: false,
                                                timer: 1000
                                            });
                                            location.reload();
                                        }
                                    }).fail(function() {
                                        alert("error");
                                    });

                                }
                            })
                        }
                    }).fail(function() {
                        alert("error");
                    });

                }
            })
        }
    </script>

    @livewireScripts
@stop
