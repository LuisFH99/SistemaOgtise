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
                                <button type="button" class="btn btn-outline-primary mr-2" id="InfGeneral">Parte
                                    Diario</button>
                                <button type="button" class="btn btn-outline-danger" id="InfFaltas">Informe de
                                    Faltas</button>
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
                                        <td><i class="far fa-address-book mr-2"
                                                onclick="GenerarReporte({{ $docente->iddocentes }})"></i>
                                            <i class="fas fa-calendar-alt"
                                                onclick="Asistencia({{ $docente->iddocentes }})"></i>
                                        </td>
                                    </tr>

                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" tabindex="-1" id="InfoAsistencias">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Asistencias de Docente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-12 p-2">
                        <div class="card">
                            <div class="card-body">
                                <h4><strong>Mis Registros de Asistencia Mensual:</strong></h4>
                                <input type="hidden" id="iddoc">
                                @csrf
                                <div class="mb-2 row">
                                    <label class="col-sm-1 col-form-label d-flex justify-content-end">MES:</label>
                                    <div class="col-sm-4 d-flex justify-content-start">
                                        <select id="meses1" class="custom-select">
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
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Salir</button>
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

            $('#tableURCT').DataTable({
                "language": {
                    "processing": "Procesando...",
                    "lengthMenu": "Mostrar _MENU_ registros",
                    "zeroRecords": "No se encontraron resultados",
                    "info":"Mostrando la página _PAGE_ de _PAGES_",
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
            selectanio(new Date().getFullYear());


            $("#meses1 option[value=" + (new Date().getMonth() + 1) + "]").attr("selected", true);

            $('#meses1').on('change', function() {
                RegistroMensual($(this).val(), $('#selectyyyy').val(), $('#iddoc').val());
            });

            $('#selectyyyy').on('change', function() {
                RegistroMensual($('#meses').val(), $(this).val(), $('#iddoc').val());
            });

        });


        $('#InfGeneral').on('click', function() {
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

        $('#InfFaltas').on('click', function() {
            //alert("la fecha es :" +$('#freporte').val());
            if ($('#freporte').val().trim() !== '') {
                window.open('/URyC/ParteDiario/general/faltas/' + $('#freporte').val(), '_blank');
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

        function limpiar() {
            $("#table th").remove();
            $("#table td").remove();
        }

        function GenerarReporte($id) {
            window.open('/URyC/ParteDiario/reporte/' + $id + '/' + $('#meses').val() + '/' + $('#year').val(), '_blank');

        }

        function selectanio1(dto) {
            for (let i = 0; i < 4; i++) {
                $('#selectyyyy').append($("<option>", {
                    value: dto - i,
                    text: dto - i
                }));
            }
        }

        function IncioRep(dto1, dto2, dto3) {
            selectanio1(dto2);
            $("#meses option[value=" + dto1 + "]").attr("selected", true);
            RegistroMensual(dto1, dto2, dto3);

        }

        function RegistroMensual(mes, aa, id) {
            $.ajax({
                url: '/URyC/docentes/registros/asistencia',
                method: 'POST',
                data: {
                    _token: $('input[name="_token"]').val(),
                    mes: mes,
                    year: aa,
                    idd: id
                }
            }).done(function(res) {
                console.log(res);
                limpiar();
                let th = "";
                let td = "";
                let td2 = "";
                //let dtito="<img src='/vendor/adminlte/dist/img/asistio.svg' onclick=AbrirModal('a')>";
                var diasMes = new Date(aa, mes, 0).getDate();
                var diasSemana = ['D0', 'LU', 'MA', 'MI', 'JU', 'VI', 'SA'];
                // console.log(res);
                // console.log(aa);

                if (res.length > 0) {
                    for (var dia = 1; dia <= diasMes; dia++) {
                        var indice = new Date(aa, mes - 1, dia).getDay();
                        th += "<th>" + diasSemana[indice] + "</th>";
                        td += "<td>" + dia + "</td>";
                        let dto = res.find(fecha => fecha.dia == dia);
                        if (dto == undefined) {
                            td2 += "<td><img src='/vendor/adminlte/dist/img/libre.svg'></td>";
                        } else {
                            td2 += "<td><img src='/vendor/adminlte/dist/img/" + dto.estado +
                                ".svg' onclick=AbrirModal('" + dto.estado + "','" + dto.dia + "','" + mes + "','" +
                                aa + "','" + id + "')></td>";
                        }
                    }

                } else {
                    for (var dia = 1; dia <= diasMes; dia++) {
                        var indice = new Date(aa, mes - 1, dia).getDay();
                        th += "<th>" + diasSemana[indice] + "</th>";
                        td += "<td>" + dia + "</td>";
                        td2 += "<td><img src='/vendor/adminlte/dist/img/libre.svg'></td>";
                    }
                }
                $('.fondo-table').append("<tr>" + th + "</tr");
                $('.bg-tr').append(td);
                $('#Aux').append(td2);
            }).fail(function() {
                Swal.fire('Falla en la envio de Datos', '', 'error');
            });

        }

        function Asistencia(iddoc) {

            $('#iddoc').val(iddoc);
            IncioRep(new Date().getMonth() + 1, new Date().getFullYear(), $('#iddoc').val());

            $('#InfoAsistencias').modal('show');
        }

        function AbrirModal(dto, dia, mes, aa, id) {
            if (dto == 2) {
                ModalJustificacion(dia, mes, aa, id)
            }
           
        }

        function ModalJustificacion(dia, mes, aa, id) {
            
            Swal.fire({
                title: 'Confirme Justificacion de Falta',
                text: "Justificara la Falta del docente",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Justificar!'
            }).then((result) => {
                if (result.isConfirmed) {

                    $.ajax({
                        url: '/URyC/docentes/registros/asistencia/justificar',
                        method: 'POST',
                        data: {
                            _token: $('input[name="_token"]').val(),
                            fecha: aa + "-" + mes + "-" + dia,
                            iddoc: id
                        }
                    }).done(function(res) {
                        if (res == 1) {
                            Swal.fire(
                                'Justificacion Completada!',
                                'Se han Guardado los cambios',
                                'success'
                            )
                            RegistroMensual(mes, aa, id);
                        }else{
                            Swal.fire(
                                'Uups!',
                                'Ocurrio un error no se guardó los cambios',
                                'error'
                            )
                        }

                    }).fail(function() {
                        Swal.fire('Falla en el envio de Datos', '', 'error');
                    });

                }
            })


        }
    </script>
@stop
