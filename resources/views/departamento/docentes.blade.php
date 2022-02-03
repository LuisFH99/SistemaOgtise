@extends('adminlte::page')

@section('title', 'Academico | Docentes')

@section('plugins.Datatables', true)

@section('content_header')
    <h1 class="text-center">Gestion de Docentes </h1>
@stop

@section('content')
    @if (session('info'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: '{{ session('info') }}',
                showConfirmButton: false,
                timer: 2500
            })
        </script>
    @endif


    <div class="container create-docente">
        <div class="card">
            {{-- <div class="card-header">
                <h4 class="">Crear Docentes</h4>
            </div> --}}
            <div class="card-body">
                <form action="{{ route('docentes.store') }}" method="POST" id="formcreardocentes">
                    <div class="row">
                        @csrf
                        <div class="col-md-2 col-sm-6">
                            <label class="form-label">DNI:</label>
                            <input type="text" class="form-control" id="dni" name="dni" placeholder="Ingrese el N° DNI"
                                tabindex="1" maxlength="8" onkeypress="return SoloNumeros(event)" autocomplete="off"
                                value={{ old('dni') }}>
                            @error('dni')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-2 col-sm-6">
                            <label class="form-label">Apellidos Paterno:</label>
                            <input type="text" id="apepat" name="apepat" class="form-control"
                                placeholder="Apellido parteno" tabindex="2" autocomplete="off" value={{ old('apepat') }}>
                            @error('apepat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-2 col-sm-6">
                            <label class="form-label">Apellidos Materno:</label>
                            <input type="text" id="apemat" name="apemat" class="form-control"
                                placeholder="Apellido Materno" tabindex="3" autocomplete="off" value={{ old('apemat') }}>
                            @error('apemat')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <label class="form-label">Nombres:</label>
                            <input type="text" id="nombres" name="nombres" class="form-control" placeholder="Nombres"
                                tabindex="4" autocomplete="off" value={{ old('nombres') }}>
                            @error('nombres')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <label class="form-label">Fecha de Nacimiento</label>
                            <input type="date" id="fnacimiento" name="fnacimiento" class="form-control" tabindex="5"
                                value={{ old('fnacimiento') }}>
                            @error('fnacimiento')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-3 col-sm-6 my-3">
                            <label class="form-label">Celular:</label>
                            <input type="text" id="numcel" name="numcel" class="form-control"
                                placeholder="Ingrese N° celular" tabindex="6" maxlength="9"
                                onkeypress="return SoloNumeros(event)" autocomplete="off" value={{ old('numcel') }}>
                            @error('numcel')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        <div class="col-md-3 col-sm-6 my-3">
                            <label class="form-label">Correo Institucional:</label>
                            <input type="email" id="email" name="correo" class="form-control"
                                placeholder="correo@unasam.edu.pe" tabindex="7" autocomplete="off"
                                value={{ old('correo') }}>
                            @error('correo')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        @livewire('crear-docentes')

                        <div class="col-md-4 col-sm-6 mb-3">
                            <label for="" class="form-label">Condición:</label>
                            <select class="form-control" id="condicion" name="condicion" tabindex="10">
                                <option>Seleccione...</option>
                                @foreach ($condiciones as $condicion)
                                    <option value="{{ $condicion->idCondiciones }}"
                                        {{ old('condicion') == $condicion->idCondicioness ? 'selected' : '' }}>
                                        {{ $condicion->nomCondi }}</option>
                                @endforeach
                            </select>
                            @error('condicion')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-4 col-sm-6 mb-3">
                            <label for="" class="form-label">Categoría:</label>
                            <select class="form-control" id="categoria" name="categoria" tabindex="11">
                                <option>Seleccione...</option>
                                @foreach ($categorias as $categoria)
                                    <option value="{{ $categoria->idCategorias }}"
                                        {{ old('categoria') == $categoria->idCategorias ? 'selected' : '' }}>
                                        {{ $categoria->nomCat }}</option>
                                @endforeach
                            </select>
                            @error('categoria')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="col-md-4 col-sm-6 mb-3">
                            <label for="" class="form-label">Dedicación:</label>
                            <select class="form-control" id="dedicacion" name="dedicacion" tabindex="12">
                                <option selected="selected" value="">Seleccione...</option>
                                @foreach ($dedicaciones as $dedicacion)
                                    <option value="{{ $dedicacion->idDedicaciones }}"
                                        {{ old('dedicacion') == $dedicacion->idDedicaciones ? 'selected' : '' }}>
                                        {{ $dedicacion->nomDedi }}</option>
                                @endforeach
                            </select>
                            @error('dedicacion')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror

                        </div>
                        <div class="col-12 mx-auto">
                            <div class="text-center">
                                <a href="{{ route('docentes') }}" class="btn btn-secondary mr-2">Cancelar</a>
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>


                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="container">
        @livewire('listar-docentes')
    </div>
    <div class="modal fade bd-example-modal-lg" id="modalEdit" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Editar Docente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="col-12">
                            {{-- @csrf --}}
                            <div class="row">
                                <div class="col-md-4 col-sm-6">
                                    <label class="form-label">DNI:</label>
                                    <input type="text" class="form-control" id="dniEdit" placeholder="Ingrese el N° DNI"
                                        tabindex="1">
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <label class="form-label">Apellidos Paterno:</label>
                                    <input type="text" id="apepatEdit" class="form-control" placeholder="" tabindex="2">
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <label class="form-label">Apellidos Materno:</label>
                                    <input type="text" id="apematEdit" class="form-control" placeholder="" tabindex="3">
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <label class="form-label">Nombres:</label>
                                    <input type="text" id="nombresEdit" class="form-control" placeholder="" tabindex="4">
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <label class="form-label">Fecha de Nacimiento</label>
                                    <input type="date" id="fnacimientoEdit" class="form-control" tabindex="5">
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <label class="form-label">Celular:</label>
                                    <input type="text" id="numcelEdit" class="form-control"
                                        placeholder="Ingrese N° celular" tabindex="6">
                                </div>
                                <div class="col-md-4 col-sm-6">
                                    <label class="form-label">Correo Institucional:</label>
                                    <input type="email" id="emailEdit" class="form-control"
                                        placeholder="correo@unasam.edu.pe" tabindex="7">
                                    <input type="hidden" id="idpersonaEdit" value="0">
                                    <input type="hidden" id="claveEdit" value="0">
                                    <input type="hidden" id="idusuEdit" value="0">
                                </div>
                                <div class="col-md-4 col-sm-6 ">
                                    <label class="form-label">Facultad:</label>
                                    <div class="input-group">
                                        <select id="facultadEdit" class="form-control" tabindex="8">

                                        </select>

                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-6 ">
                                    <label for="" class="form-label">Departamento Academico:</label>
                                    <div class="input-group">
                                        <select class="form-control" id="dptoacademicoEdit" tabindex="9">


                                        </select>

                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-6 ">
                                    <label for="" class="form-label">Condición:</label>
                                    <div class="input-group">
                                        <select class="form-control" id="condicionEdit" tabindex="10">


                                        </select>

                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-6 ">
                                    <label for="" class="form-label">Categoría:</label>
                                    <div class="input-group">
                                        <select class="form-control" id="categoriaEdit" tabindex="11">


                                        </select>

                                    </div>
                                </div>

                                <div class="col-md-4 col-sm-6 ">
                                    <label for="" class="form-label">Dedicación:</label>
                                    <div class="input-group">
                                        <select class="form-control" id="dedicacionEdit" tabindex="12">


                                        </select>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="editar">Editar</button>
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
    @if (session('info'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{ session('info') }}",

            })
        </script>
    @endif
    @if (session('success'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 1500
            })
            location.reload();
        </script>
    @endif
    <script>
        $(document).ready(function() {

            $('#tableDocentes').DataTable({
                "language": {
                    "processing": "Procesando...",
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "zeroRecords": "No se encontraron resultados",
                    "info": "Mostrando la página _PAGE_ de _PAGES_",
                    "emptyTable": "Ningún dato disponible en esta tabla",
                    "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "infoFiltered": "(filtrado de un total de _MAX_ registros)",
                    "search": "Buscar:",
                    "infoThousands": ",",
                    "loadingRecords": "Cargando...",
                    "paginate": {
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            });
            $('#email').focus(function() {
                $(this).val("" + generaremail($('#nombres').val().trim(), $('#apepat').val().trim(), $(
                    '#apemat').val().trim()));
            });

            $('#emailEdit').focus(function() {
                $(this).val("" + generaremail($('#nombresEdit').val().trim(), $('#apepatEdit').val().trim(),
                    $(
                        '#apematEdit').val().trim()));
            });

            $("#modalEdit").on('hidden.bs.modal', function() {
                Limpiar();
            });
            $('#facultadEdit').change(function() {

                $.ajax({
                    url: '/departamento/docentes/dpto',
                    method: 'POST',
                    data: {
                        _token: $('input[name="_token"]').val(),
                        idfac: $(this).val()
                    }
                }).done(function(res) {
                    $('#dptoacademicoEdit').empty();
                    //$('#dptoacademico').append("<option>Seleccione...</option>");
                    for (let i = 0; i < res.dptos.length; i++) {
                        $('#dptoacademicoEdit').append($("<option>", {
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

            /*$('#formcreardocentes').submit(function(e){
                alert("verifica el email")
                
                e.preventDefault();
                window.history.back();
            });*/
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
                $('#dniEdit').val(res.docente[0].dni);
                $('#apepatEdit').val(res.docente[0].apellpat);
                $('#apematEdit').val(res.docente[0].apellmat);
                $('#nombresEdit').val(res.docente[0].nombres);
                $('#fnacimientoEdit').val(res.docente[0].fechNacimiento);
                $('#numcelEdit').val(res.docente[0].telefono);
                $('#emailEdit').val(res.docente[0].correo);
                $('#idpersonaEdit').val(res.docente[0].idpersonas);
                $('#claveEdit').val(res.docente[0].clave);
                $('#idusuEdit').val(res.docente[0].id);

                for (let i = 0; i < res.facultades.length; i++) {
                    $('#facultadEdit').append("<option value='" + res.facultades[i].id_facultades + "'>" + res
                        .facultades[i].nomfac + "</option>");
                }
                $('#facultadEdit > option[value="' + res.docente[0].id_facultades + '"]').attr('selected',
                    'selected');

                for (let i = 0; i < res.dptos.length; i++) {
                    $('#dptoacademicoEdit').append("<option value='" + res.dptos[i].idDepAcademicos + "'>" + res
                        .dptos[i].nomdep + "</option>");
                }
                $('#dptoacademicoEdit > option[value="' + res.docente[0].idDepAcademicos + '"]').attr('selected',
                    'selected');

                for (let i = 0; i < res.condiciones.length; i++) {
                    $('#condicionEdit').append("<option value='" + res.condiciones[i].idcondiciones + "'>" + res
                        .condiciones[i].nomcondi + "</option>");
                }
                $('#condicionEdit > option[value="' + res.docente[0].idCondiciones + '"]').attr('selected',
                    'selected');

                for (let i = 0; i < res.categorias.length; i++) {
                    $('#categoriaEdit').append("<option value='" + res.categorias[i].idcategorias + "'>" + res
                        .categorias[i].nomcat + "</option>");
                }
                $('#categoriaEdit > option[value="' + res.docente[0].idCategorias + '"]').attr('selected',
                    'selected');

                for (let i = 0; i < res.dedicaciones.length; i++) {
                    $('#dedicacionEdit').append("<option value='" + res.dedicaciones[i].iddedicaciones + "'>" + res
                        .dedicaciones[i].nomdedi + "</option>");
                }
                $('#dedicacionEdit > option[value="' + res.docente[0].iddedicaciones + '"]').attr('selected',
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
                    dni: $('#dniEdit').val(),
                    nombre: $('#nombresEdit').val(),
                    appat: $('#apepatEdit').val(),
                    apmat: $('#apematEdit').val(),
                    fnac: $('#fnacimientoEdit').val(),
                    cel: $('#numcelEdit').val(),
                    clv: $('#claveEdit').val(),
                    idcnd: $('#condicionEdit').val(),
                    idcat: $('#categoriaEdit').val(),
                    iddedi: $('#dedicacionEdit').val(),
                    iddep: $('#dptoacademicoEdit').val(),
                    idper: $('#idpersonaEdit').val(),
                    idusu: $('#idusuEdit').val(),
                    correo: $('#emailEdit').val(),
                    ev: 2
                }
            }).done(function(res) {
                if (res != 1) {
                    Swal.fire({
                        position: 'top-center',
                        icon: 'success',
                        title: res[0].rpta,
                        showConfirmButton: false,
                        timer: 2500
                    })
                    $('#modalEdit').modal('hide');
                    location.reload();
                } else {
                    Swal.fire(
                        'Ooops!!',
                        '¡El correo Institucional ya esta registrado!',
                        'error'
                    )
                }

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

        function EditarSemanaDocente(id) {

            $.ajax({
                url: '/departamento/docentes/editSemana',
                method: 'POST',
                data: {
                    _token: $('input[name="_token"]').val(),
                    iddoc: id
                }
            }).done(function(res) {
                alert(res);

            }).fail(function() {
                alert("error");
            });
        }

        function Limpiar() {
            $('#facultadEdit').empty();
            $('#dptoacademicoEdit').empty();
            $('#condicionEdit').empty();
            $('#categoriaEdit').empty();
            $('#dedicacionEdit').empty();
        }

        function generaremail(nom, ap, am) {
            let dto = nom.charAt(0) + ap + am.charAt(0) + "@unasam.edu.pe";
            return dto.toLowerCase();
        }

        function SoloNumeros(e) {
            var key = Window.Event ? e.which : e.keyCode;
            if (key < 48 || key > 57) {

                e.preventDefault();
            }
        }
    </script>
@stop
