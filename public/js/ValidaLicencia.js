let idlic = 0;
$(function() {
    $('#chkCodigoFirma').prop("checked", false);
    $('#chkDNIE').prop("checked", false);
    MostarFirma();
    $("#btnAcepted").click(function() {
        AcepDene('Procesada');
    });
    $("#btnDenied").click(function() {
        AcepDene('Denegada');
    });
    $("#btnAceptedDec").click(function() {
        AcepDene('Visto Bueno');
    });
    $("#btnAceptedURyC").click(function() {
        AcepDene('Admitida');
    });
    $("#btnAceptedDRRHH").click(function() {
        AcepDene('Aprobada');
    });
});

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

function AcepDene(dto) {
    let txtCodigoFirma = $('#txtCodigoFirma').val();
    //if (validarEntradas()) { 
    $.ajax({
        url: '/departamento/ValidaLicencia/datos',
        method: 'POST',
        data: {
            _token: $('input[name="_token"]').val(),
            dt: txtCodigoFirma
        }
    }).done(function(msg) {
        //alert(msg);
        if (msg === '1') {
            $.ajax({
                url: '/departamento/ValidaLicencia/store',
                method: 'POST',
                data: {
                    _token: $('input[name="_token"]').val(),
                    idSol: idlic,
                    dt1: dto,
                    idTf: 1,
                }
            }).done(function(msg) {
                console.log('correcto: ' + msg);
                Swal.fire({
                    title: (dto === 'Denegada') ? 'Solicitud Denegada' : 'Solicitud ' + dto,
                    icon: (dto === 'Denegada') ? 'warning' : 'success',
                    confirmButtonText: 'Aceptar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }

                })
                $('#modal2').modal('hide');
            }).fail(function(msg) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops.',
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
    //}
}

function selecId(id, fecha, hr, nomb, estado1, estado2) {
    idlic = id;
    $.ajax({
        url: '/departamento/ValidaLicencia/imprimir',
        method: 'POST',
        data: {
            _token: $('input[name="_token"]').val(),
            idSol: id
        }
    }).done(function(url) {
        console.log('correcto: ' + url);
        $('#titVerArchivos').html('Licencia pedida el ' + formatoFecha(fecha) + ' a horas: ' + hr);
        $('#nombre').html('Docente: <b>' + nomb + '</b>');
        $('#verArchivos').html("<embed src='" + url + "' frameborder='0'" +
            " width='100%' height='350px'>");
        if (estado1 === estado2) {
            $("#divRow").removeClass("d-none");
            $("#divValidar").removeClass("d-none");
            $("#divAceptar").removeClass("d-flex");
            $("#divRow").addClass("d-flex");
            $("#divValidar").addClass("d-flex");
            $("#divAceptar").addClass("d-none");
        } else {
            $("#divRow").removeClass("d-flex");
            $("#divValidar").removeClass("d-flex");
            $("#divAceptar").removeClass("d-none");
            $("#divRow").addClass("d-none");
            $("#divValidar").addClass("d-none");
            $("#divAceptar").addClass("d-flex");
        }
        $('#modal2').modal('show');
    }).fail(function(msg) {
        console.log(msg);
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Algo salio mal!...'
        })
    });


}


function selecEvi(id) {
    console.log(id);
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