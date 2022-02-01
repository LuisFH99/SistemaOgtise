
let idsali = 0;
$(function() {
    $('#buscaFecha').val("{{date('Y-m-d')}}");
    $('#chkCodigoFirma').prop("checked", false);
    $('#chkDNIE').prop("checked", false);
    MostarFirma();
    $("#btnAceptar").click(function() {
        let Firma = $("#txtCodigoFirma").val();
        if (validarEntradas()) {
            $.ajax({
                url: '/Departamento/ValidaSalida/dato',
                method: 'POST',
                data: {
                    _token: $('input[name="_token"]').val(),
                    dt: Firma
                }
            }).done(function(msg) {
                if (msg === '1') {
                    let justi = $("#txtareaj").val();
                    $.ajax({
                        url: '/departamento/ValidaSalida',
                        method: 'POST',
                        data: {
                            _token: $('input[name="_token"]').val(),
                            Justif: justi,
                            idsal: idsali,
                        }
                    }).done(function(msg) {
                        Swal.fire(
                            'Excelente!',
                            'Ha validado la Salida del Docente de manera exitosa!',
                            'success'
                        )
                        $("#modal1").modal('hide');
                        location.reload();
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
});
// $('.datepicker').datepicker({
//   inline: true
// });
function MostarFirma() {

    $('#chkCodigoFirma').on("click", function() {
        if ($(this).is(":checked")) {
            $('#chkDNIE').prop("checked", false);
            $("#formclave").removeClass("d-none");
            $("#formbtn").removeClass("d-none");
            $("#formclave").addClass("d-flex");
            $("#formbtn").addClass("d-flex");

        } else {
            $("#formclave").removeClass("d-flex");
            $("#formbtn").removeClass("d-flex");
            $("#formclave").addClass("d-none");
            $("#formbtn").addClass("d-none");
        }
    });

    $('#chkDNIE').on("click", function() {
        if ($(this).is(":checked")) {
            $('#chkCodigoFirma').prop("checked", false);
            $("#formclave").removeClass("d-flex");
            $("#formbtn").removeClass("d-flex");
            $("#formclave").addClass("d-none");
            $("#formbtn").addClass("d-none");
        }
    });
}

function validarEntradas() {
    let bdr = false;
    if ($('#txtareaj').val() === '') {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Debes escribir una Observación para validar la salida!'
        })
        $("#txtareaj").focus();
    } else {
        if ($('#chkCodigoFirma').is(":checked")) {
            if ($('#txtCodigoFirma').val() != '') {
                bdr = true;
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Debe escribir la clave para validar la salida'
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
    }
    return bdr;
}

function selecId(id, nombre, fecha, hora, informe) {
    //document.getElementById('exampleModalLabel').innerHTML=""+nombre;
    idsali = id;
    $.ajax({
        url: '/Departamento/index/validando',
        method: 'POST',
        data: {
            _token: $('input[name="_token"]').val(),
            idSalida: id,
        }
    }).done(function(msg) {

        // $("#nombret").html('Docente: ' + msg.Salida.apellPat + ' ' + msg.Salida.apellMat + ' ' + msg.Salida.nombres);
        // $("#fecha").html(formatoFecha(msg.Salida.fecha) + " - " + msg.Salida.hor_salida);
        // $("#justificacion").html(msg.Salida.informe);
        $("#nombret").html('Docente: ' + nombre);
        $("#fecha").html(formatoFecha(fecha) + " - " + hora);
        $("#justificacion").html(informe);
        let ArrayE = msg.evi;
        let mj = "";
        ArrayE.forEach(function(element) {
            mj = mj + "<a href='#'  class='text-secondary'" +
                "onclick='selecEvi(" + element.idEvidencias + ",\"" + element.docs + "\")'><i class='far fa-file-pdf'>" +
                "</i> Reporte " + numAlet(element.idEvidencias) + "</a><br>";
        });
        $("#archivos").html(mj);
        $("#modal1").modal('show');
    }).fail(function(msg) {
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Algo salio mal!'
        })
    });
}

function selecEvi(num, dir) {
    let numl = (num < 10) ? '0' + num : '' + num;
    $("#titVerArchivos").html("Reporte N° " + numl);
    $("#verArchivos").html("<embed src='" + dir + "' frameborder='0' width='100%' height='400px'>");
    $("#modal2").modal('show');
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

function formatoFecha(dato) {
    dato = dato.toString();
    date = new Date(dato);
    const months = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
    const days = ["Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado", "Domingo"];
    let fecha = dato.split("-");
    let formatted_date = days[date.getDay()] + ", " + fecha[2] + " de " + months[parseInt(fecha[1]) - 1] + " de " + date.getFullYear();
    return formatted_date;
}

function numAlet(num) {
    const letra = ["Cero", "Uno", "Dos", "Tres", "Cuatro", "Cinco", "Seis", "Siete", "Ocho", "Nueve", "Diez"];
    return letra[num];
}
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