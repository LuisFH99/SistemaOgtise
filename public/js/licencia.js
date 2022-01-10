let idMot = 0;
let idSoli = 0;
let desde = new Date($('#desde').val()).getTime();
let hasta = new Date($('#hasta').val()).getTime();
let ndias = 0;
let fech = ($('#fechs').val()).split(',');
let fechita = new Date($('#desde').val());
Dropzone.options.myAwesomeDropzone = { // camelized version of the `id`
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //'X-CSRF-TOKEN':"{{csrf_token()}}"
            //'X-CSRF-TOKEN': window.CSRF_TOKEN// <--- aquí el token
    },
    autoProcessQueue: false,
    paramName: "file", // The name that will be used to transfer the file
    maxFilesize: 10, // MB
    maxFiles: 5,
    addRemoveLinks: false, // Don't show remove links on dropzone itself.
    dictDefaultMessage: "Arrastra los archivos aquí para subirlos",

    init: function() {
        var submitButton = document.querySelector("#btnSolicitar1");
        var wrapperThis = this;

        submitButton.addEventListener("click", function() {
            wrapperThis.processQueue();
            console.log('file subido');
        });

        this.on("addedfile", function(file) {

            // Create the remove button
            var removeButton = Dropzone.createElement("<button class='btn btn-lg dark'>" +
                "<i class='fa fa-trash' aria-hidden='true'></i>Eliminar</button>");

            // Listen to the click event
            removeButton.addEventListener("click", function(e) {
                // Make sure the button click doesn't submit the form:
                e.preventDefault();
                e.stopPropagation();

                // Remove the file preview.
                wrapperThis.removeFile(file);
                // If you want to the delete the file on the server as well,
                // you can do the AJAX request here.
            });

            // Add the button to the file preview element.
            file.previewElement.appendChild(removeButton);
        });

        this.on('sendingmultiple', function(data, xhr, formData) {
            formData.append("idSol", idSoli);
        });
    }

};

$(function() {
    $('#chkCodigoFirma').prop("checked", false);
    $('#chkDNIE').prop("checked", false);

    MostarFirma();
    $('#reincorporar').html(formatoFecha(devolverFechaLab(hasta)));
    $('#desde').change(function() {
        desde = new Date($(this).val()).getTime();
        ndias = (((hasta - desde) / (1000 * 60 * 60 * 24)) + 1);

        let bdr1 = " dias"
        if (ndias === 1) {
            bdr1 = " dia";
        }
        $('#dias').html(ndias + "" + bdr1);
    });
    $('#hasta').change(function() {
        hasta = new Date($(this).val()).getTime();
        ndias = (((hasta - desde) / (1000 * 60 * 60 * 24)) + 1);
        let bdr1 = " dias"
        if (ndias === 1) {
            bdr1 = " dia";
        }
        $('#dias').html(ndias + "" + bdr1);
        $('#reincorporar').html(formatoFecha(devolverFechaLab($(this).val())));
    });

    $("#btnSolicitar").click(function() {
        ini = $('#desde').val();
        fin = $('#hasta').val();
        let txtareajus = $('#txtareajus').val();
        let dias = ndias;
        let reincorporar = devolverFechaLab(hasta);
        let txtCodigoFirma = $('#txtCodigoFirma').val();
        let fEODe = '1';
        if (validarEntradas()) {
            $.ajax({
                url: '/docentes/licencias/dato',
                method: 'POST',
                data: {
                    _token: $('input[name="_token"]').val(),
                    dt: txtCodigoFirma
                }
            }).done(function(msg) {
                if (msg === '1') {
                    $.ajax({
                        url: '/docentes/licencias/store',
                        method: 'POST',
                        data: {
                            _token: $('input[name="_token"]').val(),
                            Motivo: idMot,
                            Justificacion: txtareajus,
                            Fdesde: ini,
                            Fhasta: fin,
                            Ndias: dias,
                            reinc: reincorporar,
                            idTf: fEODe
                        }
                    }).done(function(res) {
                        idSoli = res.idSoli;
                        document.getElementById("btnSolicitar1").click();

                        const swalWithBootstrapButtons = Swal.mixin({
                            customClass: {
                                confirmButton: 'btn btn-outline-success'
                            },
                            buttonsStyling: false
                        });
                        //document.getElementById("btnSolicitar2").click();
                        swalWithBootstrapButtons.fire({
                            title: '<strong>ENVÍO EXITOSO</strong>',
                            icon: 'success',
                            html: "<div class='col-14 p-2 '>" +
                                "<div class='card fondo-cards'>" +
                                "<div class='table-responsive'>" +
                                "<table class='table table-sm ' id='tableCodigo'>" +
                                "<tbody>" +
                                "<tr>" +
                                "<td>Código de solicitud</td>" +
                                "<td class='dr'>" + res.codSoli + "</td>" +
                                "</tr>" +
                                "<tr>" +
                                "<td>Fecha de envío:</td>" +
                                "<td class='d'>" + res.fecha + " " + res.hora + "</td>" +
                                "</tr>" +
                                " </tbody>" +
                                "</table>" +
                                "</div>" +
                                "</div>" +
                                "</div>" +
                                "<center><p class='text-secondary'>Te hemos enviado una copia de esta constancia a tu correo institucional</p></center>",
                            confirmButtonText: 'Aceptar'
                        }).then((result) => {
                            /* Read more about isConfirmed, isDenied below */
                            if (result.isConfirmed) {
                                location.reload();
                            }
                        })

                    }).fail(function(msg) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Algo salio mal!'
                        })
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'La contraseña no es Correcta!'
                    })
                }
            }).fail(function(msg) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Algo salio mal!...'
                })
            });
        }
    });
    // $('#btnSolicitar2').click(function() {
    //     $.ajax({
    //         url: '/docentes/PDFs/imprimir',
    //         method: 'POST',
    //         data: {
    //             _token: $('input[name="_token"]').val(),
    //             idSol: idSoli
    //         }
    //     }).done(function(msg) {
    //         console.log('correcto: ' + msg);
    //     }).fail(function(msg) {
    //         Swal.fire({
    //             icon: 'error',
    //             title: 'Oops...',
    //             text: 'Algo salio mal!...'
    //         })
    //     });
    // });
});

function MostarFirma() {

    $('#chkCodigoFirma').on("click", function() {
        if ($(this).is(":checked")) {
            $('#chkDNIE').prop("checked", false);
            $("#formclave").removeClass("d-none");
            $("#btnSolicitar").removeClass("d-none");
            $("#formclave").addClass("d-flex");
            $("#btnSolicitar").addClass("d-flex");

        } else {
            $("#formclave").removeClass("d-flex");
            $("#btnSolicitar").removeClass("d-flex");
            $("#formclave").addClass("d-none");
            $("#btnSolicitar").addClass("d-none");
        }
    });

    $('#chkDNIE').on("click", function() {
        if ($(this).is(":checked")) {
            $('#chkCodigoFirma').prop("checked", false);
            $("#formclave").removeClass("d-flex");
            $("#btnSolicitar").removeClass("d-flex");
            $("#formclave").addClass("d-none");
            $("#btnSolicitar").addClass("d-none");
        }
    });
}

function selecMotivo(id) {
    console.log('->' + id);
    //addElement1('label','Requerimientos', 'Nota',id);
    idMot = id;
    switch (id) {
        case 1: //comision de servicio
            console.log('caso->' + id);
            addElement1('p', '* Con documento Sustentatorio <br>' +
                '* No debera exceder los 30 dias calendario', 'Nota1', id, 'Comisión de Servicio');
            $("#desde").attr("min", fech[0]);
            $("#hasta").attr("min", fech[0]);
            fechita = new Date(fech[0]);
            break;
        case 2: //a cuenta de vacaciones
            console.log('caso->' + id);
            addElement1('p', '* Art. 110 (c) D.S. 005-90-PCM <br>' +
                '* Por Matrimonio <br>' +
                '* Por enfermedad Grave del Cónyuge, padres o hijos', 'Nota1', id, 'A cuenta de Vacaciones');
            $("#desde").attr("min", fech[0]);
            $("#hasta").attr("min", fech[0]);
            fechita = new Date(fech[0]);
            break;
        case 3: //Asuntos Particulares
            console.log('caso->' + id);
            addElement1('p', '* Sin goce de haber', 'Nota1', id, 'Asuntos Particulares');
            $("#desde").attr("min", fech[0]);
            $("#hasta").attr("min", fech[0]);
            fechita = new Date(fech[0]);
            break;
        case 4: //Enfermedad
            addElement1('p', '* Certificado médico', 'Nota1', id, 'Enfermedad');
            $("#desde").attr("min", fech[1]);
            $("#hasta").attr("min", fech[1]);
            fechita = new Date(fech[1]);
            break;
        case 5: //Vacaciones
            addElement1('p', '* Ninguno', 'Nota1', id, 'Vacaciones');
            $("#desde").attr("min", fech[0]);
            $("#hasta").attr("min", fech[0]);
            fechita = new Date(fech[0]);
            break;
        case 6: //Compensación
            addElement1('p', '* Ninguno', 'Nota1', id, 'Compensación');
            $("#desde").attr("min", fech[0]);
            $("#hasta").attr("min", fech[0]);
            fechita = new Date(fech[0]);
            break;
        case 7: //Capacitación
            addElement1('p', '* Ninguno', 'Nota1', id, 'Capacitación');
            $("#desde").attr("min", fech[0]);
            $("#hasta").attr("min", fech[0]);
            fechita = new Date(fech[0]);
            break;
        case 8: //Gravidez
            addElement1('p', '* Ninguno', 'Nota1', id, 'Gravidez');
            $("#desde").attr("min", fech[1]);
            $("#hasta").attr("min", fech[1]);
            fechita = new Date(fech[1]);
            break;
        case 9: //Onomástico
            addElement1('p', '* Ninguno', 'Nota1', id, 'Onomástico');
            $("#desde").attr("min", fech[0]);
            $("#hasta").attr("min", fech[0]);
            fechita = new Date(fech[0]);
            break;
        case 10: //Sepelio y luto
            addElement1('p', '*Ninguno', 'Nota1', id, 'Sepelio y Luto');
            $("#desde").attr("min", fech[1]);
            $("#hasta").attr("min", fech[1]);
            fechita = new Date(fech[1]);
            break;
        case 11: //Citas Médicas
            addElement1('p', '*Ninguno', 'Nota1', id, 'Cítas Médicas');
            $("#desde").attr("min", fech[0]);
            $("#hasta").attr("min", fech[0]);
            fechita = new Date(fech[0]);
            break;
        case 12: //Paternidad
            addElement1('p', '* DS N°014-2010-TR (Reglamento ley N° 29409)', 'Nota1', id, 'Paternidad');
            $("#desde").attr("min", fech[1]);
            $("#hasta").attr("min", fech[1]);
            fechita = new Date(fech[1]);
            break;
        case 13: //Oncologia
            addElement1('p', '* Ley N° 30012', 'Nota1', id, 'Oncología');
            $("#desde").attr("min", fech[0]);
            $("#hasta").attr("min", fech[0]);
            fechita = new Date(fech[0]);
            break;
        default:
            addElement1('p', '*Especifique', 'Nota1', id, 'Seleccionar Motivo');
            $("#desde").attr("min", fech[0]);
            $("#hasta").attr("min", fech[0]);
            fechita = new Date(fech[0]);
    }
}

function addElement1(tipo, texto, lugar, val, ele) {
    document.getElementById('' + lugar).innerHTML = "";
    var lbb = document.createElement('' + tipo);
    lbb.innerHTML = '' + texto;
    lbb.setAttribute('id', '' + tipo.substr(0, 2) + '' + val);
    document.getElementById('' + lugar).appendChild(lbb);
    document.getElementById('dropdownMenuButton').innerHTML = "" + ele;
}

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

function selectId(id) {
    $.ajax({
        url: '/licencia/index/datos',
        method: 'POST',
        data: {
            _token: $('input[name="_token"]').val(),
            dt: id,
        }
    }).done(function(res) {
        //alert(res.url_doc);
        $('#labelPDF').html('Licencia pedida el ' + res.fech_solicitud + ' a horas: ' + res.hor_solicitud);
        $('#mostrarPDF').html("<embed src='" + res.url_doc + "' frameborder='0'" +
            " width='100%' height='400px'>");
        $('#modalPDF').modal('show');
    }).fail(function(msg) {
        alert("error");
    });

    //event.preventDefault();
    //idp=id;
}

function selectId1(fech, hra, url) {

    $('#labelPDF').html('Licencia pedida el ' + fech + ' a horas: ' + hra);
    $('#mostrarPDF').html("<embed src='" + url + "' frameborder='0'" +
        " width='100%' height='400px'>");
    $('#modalPDF').modal('show');

}

function imprimir(idS, fech, hra) {
    $.ajax({
        url: '/docentes/PDFs/imprimir',
        method: 'POST',
        data: {
            _token: $('input[name="_token"]').val(),
            idSol: idS
        }
    }).done(function(url) {
        console.log('correcto: ' + url);
        selectId1(fech, hra, url);
    }).fail(function(msg) {
        console.log(msg);
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Algo salio mal!...'
        })
    });
}

function eliminar(id) {
    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-danger mr-1',
            cancelButton: 'btn btn-secondary mr-1'
        },
        buttonsStyling: false
    })

    swalWithBootstrapButtons.fire({
        title: 'Estas Seguro?',
        text: "Esta accion es Irreversible!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Eliminar!',
        cancelButtonText: 'Cancelar!',
        reverseButtons: false
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/docentes/licencias/eliminar',
                method: 'POST',
                data: {
                    _token: $('input[name="_token"]').val(),
                    idSol: id
                }
            }).done(function(msg) {
                if (parseInt(msg) === 1) {
                    Swal.fire({
                        icon: 'info',
                        title: 'Solicitud ELIMINADA ',
                        showConfirmButton: false,
                        timer: 4500
                    });
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Solicitud La solicitus esta en revisión, no se puede eliminar',
                        showConfirmButton: false,
                        timer: 4500
                    });
                }

                location.reload();
            }).fail(function(msg) {
                console.log(msg);
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Algo salio mal!...'
                })
            });

        }
    })
}

function formatoFecha(dato) { //2021-12-09
    dato = dato.toString();
    date = new Date(dato);
    const months = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
    const days = ["Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado", "Domingo"];
    let fecha = dato.split("-");
    let formatted_date = days[date.getDay()] + ", " + fecha[2] + " de " + months[parseInt(fecha[1]) - 1] + " de " + date.getFullYear();
    return formatted_date;
}

function devolverFechaLab(d) {
    let ds = new Date(d);
    ds.setDate(ds.getDate() + 1);
    // switch (ds.getDay()) {
    //     case 4: //Viernes
    //         ds.setDate(ds.getDate() + 3);
    //         console.log('caso->' + d);
    //         break;
    //     case 5: //Sabado
    //         ds.setDate(ds.getDate() + 2);
    //         console.log('caso->' + d);
    //         break;
    //     case 6: //Domingo
    //         ds.setDate(ds.getDate() + 1);
    //         console.log('caso->' + d);
    //         break;
    //     default:
    //         ds = new Date(ds);
    // }
    return ds.toISOString().slice(0, 10);
}

function validarEntradas() {
    let bdr = false;
    let fech1 = new Date(fechita);
    let fech2 = new Date($('#desde').val());
    let fech3 = new Date($('#hasta').val());
    if (idMot > 0) {
        if ($('#txtareajus').val() === '') {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Debes escribir una JUSTIFICACION para solicitar tu licencia!'
            })
            $("#txtareajus").focus();
        } else {
            if (ndias > 0) {
                if ((+fech1 < +fech2)) {
                    if ((+fech1 < +fech3)) {
                        if ($('#chkCodigoFirma').is(":checked")) {
                            if ($('#txtCodigoFirma').val() != '') {
                                bdr = true;
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Debe escribir la clave para validar su Solicitud'
                                })
                                $("#txtCodigoFirma").focus();
                            }
                        } else {
                            if ($('#chkDNIE').is(":checked")) {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'No cuentas con el software instalado'
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Debe elegir una forma de Validacion para su firma'
                                })
                            }
                            $("#chkCodigoFirma").focus();
                        }
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'La licencia no se puede pedir en la fecha escrita'
                        })
                        $("#desde").focus();
                    }
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'La licencia no se puede pedir en la fecha escrita'
                    })
                    $("#desde").focus();
                }
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'La fecha límite de la licencia debe ser mayor a la fecha de inicio'
                })
                $("#hasta").focus();
            }
        }
    } else {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Debes seleccionar un MOTIVO para solicitar tu licencia!'
        })
        $("#dropdownMenuButton").focus();
    }
    return bdr;
}
// the selector will match all input controls of type :checkbox
// and attach a click event handler 
$("input:checkbox").on('click', function() {
    // in the handler, 'this' refers to the box clicked on
    var $box = $(this);
    if ($box.is(":checked")) {
        // the name of the box is retrieved using the .attr() method
        // as it is assumed and expected to be immutable
        var group = "input:checkbox[name='" + $box.attr("name") + "']";
        // the checked state of the group/box on the other hand will change
        // and the current value is retrieved using .prop() method
        $(group).prop("checked", false);
        $box.prop("checked", true);
    } else {
        $box.prop("checked", false);
    }
});