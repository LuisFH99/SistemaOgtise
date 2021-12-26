@extends('adminlte::page')

@section('title', 'Academico | Docentes')

@section('plugins.Datatables', true)

@section('content_header')
    <h1 class="text-center">Lista de Docentes Registrados</h1>
@stop

@section('content')
    <div class="container">
        {{-- <div class="row">
            <a href="{{ route('creardocente') }}" class="btn btn-primary my-2">Registar Docente</a>
            <table id="tableDocentes" class="table table-sm shadow-lg">
                <thead class="text-white">
                    <tr>
                        <th scope="col">N°</th>
                        <th scope="col">Apellidos y Nombres</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Celular</th>
                        <th scope="col">Facultad</th>
                        <th scope="col">Depatameto Académico</th>
                        <th scope="col">Condición</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Dedicación</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>01</td>
                        <td>Miriam Lucero Gonzales de la Puerta</td>
                        <td>mlucerop@unasam.edu.pe</td>
                        <td>987456321</td>
                        <td>Ciencias</td>
                        <td>Ingenieria de Sistemas y Telecomunicaciones</td>
                        <td>Nombrado</td>
                        <td>Principal</td>
                        <td>Dedicacion Exclusiva</td>
                        <td>
                            <div class="centrado">
                                <span><i class="fas fa-eye mr-2"></i></span>
                                <span><i class="far fa-trash-alt"></i></span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>02</td>
                        <td>Cesar Manuel Gregorio Davila Paredes</td>
                        <td>cdavilap@unasam.edu.pe</td>
                        <td>987456321</td>
                        <td>Ciencias</td>
                        <td>Matematica</td>
                        <td>Contradado</td>
                        <td>Auxiliar</td>
                        <td>Tiempo Completo</td>
                        <td>
                            <div class="centrado">
                                <span><i class="fas fa-eye mr-2"></i></span>
                                <span><i class="far fa-trash-alt"></i></span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>03</td>
                        <td>Kiko Feliz Depaz Celi</td>
                        <td>kdepazc@unasam.edu.pe</td>
                        <td>987456321</td>
                        <td>Ingenieria Civil</td>
                        <td>Arquitectura</td>
                        <td>Contratado</td>
                        <td>Auxiliar</td>
                        <td>Tiempo Parcial</td>
                        <td>
                            <div class="centrado">
                                <span><i class="fas fa-eye mr-2"></i></span>
                                <span><i class="far fa-trash-alt"></i></span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div> --}}
        @livewire('listar-docentes')
    </div>
    <div class="modal fade bd-example-modal-lg" id="modalEdit" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="col-12">
                            @csrf
                            <div class="row">
                                <div class="col-md-4 col-sm-6">
                                    <label class="form-label">DNI:</label>
                                    <input type="text" class="form-control" id="dni" name="dni"
                                        placeholder="Ingrese el N° DNI" tabindex="1">
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <label class="form-label">Apellidos Paterno:</label>
                                    <input type="text" id="apepat" name="apepat" class="form-control" placeholder=""
                                        tabindex="2">
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <label class="form-label">Apellidos Materno:</label>
                                    <input type="text" id="apemat" name="apemat" class="form-control" placeholder=""
                                        tabindex="3">
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <label class="form-label">Nombres:</label>
                                    <input type="text" id="nombres" name="nombres" class="form-control" placeholder=""
                                        tabindex="4">
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <label class="form-label">Fecha de Nacimiento</label>
                                    <input type="date" id="fnacimiento" name="fnacimiento" class="form-control"
                                        tabindex="5">
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <label class="form-label">Celular:</label>
                                    <input type="text" id="numcel" name="numcel" class="form-control"
                                        placeholder="Ingrese N° celular" tabindex="6">
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <label class="form-label">Correo Institucional:</label>
                                    <input type="email" id="email" name="email" class="form-control"
                                        placeholder="correo@unasam.edu.pe" tabindex="7">
                                    <input type="hidden" name="idpersona" id="idpersona" value="0">
                                    <input type="hidden" name="clave" id="clave" value="0">
                                    <input type="hidden" name="idusu" id="idusu" value="0">
                                </div>
                                <div class="col-md-4 col-sm-6 ">
                                    <label class="form-label">Facultad:</label>
                                    <div class="input-group">
                                        <select id="facultad" name="facultad" class="form-control" tabindex="8">
                                            {{-- <option>Seleccione...</option> --}}

                                        </select>

                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-6 ">
                                    <label for="" class="form-label">Departamento Academico:</label>
                                    <div class="input-group">
                                        <select class="form-control" id="dptoacademico" name="dptoacademico" tabindex="9">
                                            {{-- <option selected>Seleccione...</option> --}}

                                        </select>

                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-6 ">
                                    <label for="" class="form-label">Condición:</label>
                                    <div class="input-group">
                                        <select class="form-control" id="condicion" name="condicion" tabindex="10">
                                            {{-- <option>Seleccione...</option> --}}

                                        </select>

                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-6 ">
                                    <label for="" class="form-label">Categoría:</label>
                                    <div class="input-group">
                                        <select class="form-control" id="categoria" name="categoria" tabindex="11">
                                            {{-- <option>Seleccione...</option> --}}

                                        </select>

                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-6 ">
                                    <label for="" class="form-label">Dedicación:</label>
                                    <div class="input-group">
                                        <select class="form-control" id="dedicacion" name="dedicacion" tabindex="12">
                                            {{-- <option>Seleccione...</option> --}}

                                        </select>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="editar">Editar</button>
                    {{-- <button type="button" class="btn btn-danger" id="eliminar">Eliminar</button> --}}
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>

                </div>
            </div>
        </div>
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/style.css">
@stop

@section('js')
    @livewireScripts
    <script>
        $(document).ready(function() {

            $('#tableDocentes').DataTable();
            $("#modalEdit").on('hidden.bs.modal', function() {
                Limpiar();
            });
            $('#facultad').change(function() {

                $.ajax({
                    url: '/departamento/docentes/dpto',
                    method: 'POST',
                    data: {
                        _token: $('input[name="_token"]').val(),
                        idfac: $(this).val()
                    }
                }).done(function(res) {
                    console.log(res)
                    $('#dptoacademico').empty();
                    //$('#dptoacademico').append("<option>Seleccione...</option>");
                    for (let i = 0; i < res.dptos.length; i++) {
                        $('#dptoacademico').append($("<option>", {
                            value: res.dptos[i].idDepAcademicos,
                            text: res.dptos[i].nomdep
                        }));
                    }
                }).fail(function() {
                    alert("error");
                });
            });
            $('#editar').on('click', function() {
                EditarDocente();
            });
            $('#eliminar').on('click', function() {
                EliminarDocente();
            });
        });

        function MostarModal(dto) {
            $.ajax({
                url: '/departamento/docentes/edit',
                method: 'POST',
                data: {
                    _token: $('input[name="_token"]').val(),
                    idper: dto
                }
            }).done(function(res) {
                $('#dni').val(res.docente[0].dni);
                $('#apepat').val(res.docente[0].apellpat);
                $('#apemat').val(res.docente[0].apellmat);
                $('#nombres').val(res.docente[0].nombres);
                $('#fnacimiento').val(res.docente[0].fechNacimiento);
                $('#numcel').val(res.docente[0].telefono);
                $('#email').val(res.docente[0].correo);
                $('#idpersona').val(res.docente[0].idpersonas);
                $('#clave').val(res.docente[0].clave);
                $('#idusu').val(res.docente[0].id);

                for (let i = 0; i < res.facultades.length; i++) {
                    $('#facultad').append("<option value='" + res.facultades[i].id_facultades + "'>" + res
                        .facultades[i].nomfac + "</option>");
                }
                $('#facultad > option[value="' + res.docente[0].id_facultades + '"]').attr('selected', 'selected');

                for (let i = 0; i < res.dptos.length; i++) {
                    $('#dptoacademico').append("<option value='" + res.dptos[i].idDepAcademicos + "'>" + res.dptos[
                        i].nomdep + "</option>");
                }
                $('#dptoacademico > option[value="' + res.docente[0].idDepAcademicos + '"]').attr('selected',
                    'selected');

                for (let i = 0; i < res.condiciones.length; i++) {
                    $('#condicion').append("<option value='" + res.condiciones[i].idcondiciones + "'>" + res
                        .condiciones[i].nomcondi + "</option>");
                }
                $('#condicion > option[value="' + res.docente[0].idCondiciones + '"]').attr('selected', 'selected');

                for (let i = 0; i < res.categorias.length; i++) {
                    $('#categoria').append("<option value='" + res.categorias[i].idcategorias + "'>" + res
                        .categorias[i].nomcat + "</option>");
                }
                $('#categoria > option[value="' + res.docente[0].idCategorias + '"]').attr('selected', 'selected');

                for (let i = 0; i < res.dedicaciones.length; i++) {
                    $('#dedicacion').append("<option value='" + res.dedicaciones[i].iddedicaciones + "'>" + res
                        .dedicaciones[i].nomdedi + "</option>");
                }
                $('#dedicacion > option[value="' + res.docente[0].iddedicaciones + '"]').attr('selected',
                    'selected');
                // location.reload();
            }).fail(function() {
                alert("error");
            });
            $('#modalEdit').modal('show');
        }

        function EditarDocente() {
            $.ajax({
                url: '/departamento/docentes/update',
                method: 'POST',
                data: {
                    _token: $('input[name="_token"]').val(),
                    dni: $('#dni').val(),
                    nombre: $('#nombres').val(),
                    appat: $('#apepat').val(),
                    apmat: $('#apemat').val(),
                    fnac: $('#fnacimiento').val(),
                    cel: $('#numcel').val(),
                    clv: $('#clave').val(),
                    idcnd: $('#condicion').val(),
                    idcat: $('#categoria').val(),
                    iddedi: $('#dedicacion').val(),
                    iddep: $('#dptoacademico').val(),
                    idper: $('#idpersona').val(),
                    idusu: $('#idusu').val(),
                    correo: $('#email').val(),
                    ev: 2
                }
            }).done(function(res) {
                Swal.fire({
                    position: 'top-center',
                    icon: 'success',
                    title: res[0].rpta,
                    showConfirmButton: false,
                    timer: 2500
                })

                $('#modalEdit').modal('hide');
                location.reload();

            }).fail(function() {
                alert("error");
            });
        }

        function EliminarDocente(dni, usu, idper) {
            
            Swal.fire({
                title: 'El docente se Eliminara de forma Permanente',
                text: "No se podrá revertir esta accion!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Si, Eliminar!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/departamento/docentes/delete',
                        method: 'POST',
                        data: {
                            _token: $('input[name="_token"]').val(),
                            dni: dni,
                            idusu: usu,
                            idper: idper,
                            ev: 3
                        }
                    }).done(function(res) {
                        console.log(res)
                        if (res[0].rpta == 1) {
                            Swal.fire(
                                'Eliminado!',
                                'El registro de se eliminó correctamente',
                                'success'
                            );
                            location.reload();
                        }
                    }).fail(function() {
                        alert("error");
                    });

                }
            })

        }

        function Limpiar() {
            $('#facultad').empty();
            $('#dptoacademico').empty();
            $('#condicion').empty();
            $('#categoria').empty();
            $('#dedicacion').empty();
         }
    </script>
@stop
