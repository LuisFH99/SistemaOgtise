function CapturarDocente(){
navigator.mediaDevices.getUserMedia({
    audio: false,
    video: true
}).then((stream) => {
    if (stream) {
        let video = document.getElementById('video');
        video.srcObject = stream;
        video.onloadedmetadata = (ev) => video.play();
        var canvas = document.getElementById('canvas');

        $('#grabar').click(function() {
            canvas.getContext('2d').drawImage(video, 0, 0, video.videoWidth, video.videoHeight,0, 0, 198, 150);
            var data = canvas.toDataURL('image/png');
            $.ajax({
                url: '/docentes/entrada/registrar',
                method: 'POST',
                data: {
                    _token: $('input[name="_token"]').val(),
                    firma: $('#txtCodigoFirma').val(),
                    foto: data


                }
            }).done(function(res) {
                alert(res);
                location.reload();
            }).fail(function() {
                alert("error");
            });
        });
    }
}).catch((err) => {
    console.log(err);
})
}

$(function() {
    
    if($('#aux').val()==1){
      
        CapturarDocente();
    }
    
});

function RegistroAsistencia(tp){
    if(tp==1){
        $('#divEntrada').css('display', 'block');
        $('#divSalida').css('display', 'none');
        CapturarDocente();
    }else{
        $('#divEntrada').css('display', 'none');
        $('#divSalida').css('display', 'block');
        $('#grabar').click(function() {
            $.ajax({
                url: '/docentes/salida/registrar',
                method: 'POST',
                data: {
                    _token: $('input[name="_token"]').val(),
                    firma: $('#txtCodigoFirma').val(),
                    actividad: $('#actividad').val(),

                }
            }).done(function(res) {
                alert(res);
            }).fail(function() {
                alert("error");
            });
        }); 
    }
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

function AbrirModal(dto) {
    switch (dto) {
        case 'a':
            ModalAsistio();
            break;
        case 'f':
            ModalFalto();
            break;
        case 'j':
            ModalJusticado();
            break;
        case 'l':
            ModalLicencia();
            break;
    }
}

function ModalAsistio() {
    $('#tituloModal').text('Detalle Registro de Asistencia');
    $('#Asistencia').css('display', 'block');
    $('#Jusficacion').css('display', 'none');

    $('#AsisteciaModal').modal('show');
}

function ModalFalto() {
    $('#tituloModal').text('Justificar Falta');
    $('#Jusficacion').css('display', 'block');
    $('#Asistencia').css('display', 'none');
    $('#AsisteciaModal').modal('show');
}

function ModalJusticado() {
    $('#tituloModal').text('Detalle de Justificación');
    $('#AsisteciaModal').modal('show');
}

function ModalLicencia() {
    $('#tituloModal').text('Detalle de Licencia');
    $('#AsisteciaModal').modal('show');
}