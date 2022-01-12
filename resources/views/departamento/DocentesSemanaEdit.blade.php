@extends('adminlte::page')

@section('title', 'Inicio')

@section('plugins.Datatables', true)

@section('content_header')
    <h1>Asignar Dias Laborables</h1>
@stop

@section('content')

    <div class="container">
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
                        @if (isset($cargoDocente))
                            <input name="id" id="id" type="hidden" value="{{ $cargoDocente->idcargos }}">
                        @else
                            <input name="id" id="id" type="hidden" value="0">
                        @endif

                        @foreach ($Semanas as $Semana)
                            {{-- <div> --}}
                            <label class="form-check-label mr-3">
                                {{-- {!! Form::checkbox('cbox'.$Semana->idSemanas, $Semana->idSemanas, null, ['class'=>'mr-1']) !!} --}}
                                <input type="checkbox" name='cbox{{ $Semana->idSemanas }}'
                                    id='cbox{{ $Semana->idSemanas }}' value="{{ $Semana->idSemanas }}">
                                {{ $Semana->dia }}
                            </label>
                            {{-- </div> --}}
                        @endforeach
                        <br><br>
                        <p class="h5">Cargo Desinado:</p>
                        @if (isset($cargoDocente))
                            <div class="row">
                                <input class="form-control col-md-10 cargo" type="text" value="{{ $cargoDocente->cargo }}"
                                    readonly><span class="col-md-2"><i class="fas fa-backspace"
                                        onclick="Borrar()"></i></span>
                            </div>

                        @else
                            <div class="row">
                                <input class="form-control col-md-10 cargo" type="text" value="Ningún cargo designado"
                                    readonly> <span class="col-md-2"><i class="fas fa-backspace"
                                        onclick="Borrar()"></i></span>
                            </div>
                        @endif
                        <br>

                        {!! Form::submit('Guardar Cambios', ['class' => 'btn btn-primary mt-2']) !!}
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
                    [5],
                    [5]
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
