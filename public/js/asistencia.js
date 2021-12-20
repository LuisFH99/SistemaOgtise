$(function() {
    
    if($('#aux').val()==1){
        CapturarDocente();
    }

    


    $("#meses option[value="+ 12 +"]").attr("selected",true);
    RegistroMensual(new Date().getMonth()+1);
    MostarFirma();
    

   
});



//funciones

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
                // location.reload();
            }).fail(function() {
                alert("error");
            });
        });
    }
}).catch((err) => {
    console.log(err);
})
}

function limpiar(){
    $("#table th").remove();
    $("#table td").remove();   
}

let th=""; let td=""; let td2="";

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

function MostarFirma(){
    
     $('#chkCodigoFirma').on("click", function(){
        if ($(this).is(":checked")) {
            $('#chkDNIE').prop("checked",false);
            $("#formclave").removeClass("d-none");
            $("#formbtn").removeClass("d-none");
            $("#formclave").addClass("d-flex");
            $("#formbtn").addClass("d-flex");
            
        }else{
            $("#formclave").removeClass("d-flex");
            $("#formbtn").removeClass("d-flex");
            $("#formclave").addClass("d-none");
            $("#formbtn").addClass("d-none");
        }
     });

     $('#chkDNIE').on("click", function(){
        if ($(this).is(":checked")) {
            $('#chkCodigoFirma').prop("checked",false);
            $("#formclave").removeClass("d-flex");
            $("#formbtn").removeClass("d-flex");
            $("#formclave").addClass("d-none");
            $("#formbtn").addClass("d-none");
        }
     });
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


function RegistroMensual(mes){
    limpiar()
    let th=""; let td=""; let td2="";
    let dtito="<img src='/vendor/adminlte/dist/img/asistio.svg' onclick=AbrirModal('a')>";
    var diasMes = new Date(2021, mes, 0).getDate();
    var diasSemana = ['D0', 'LU', 'MA', 'MI', 'JU', 'VI', 'SA'];
    // let th=""; let td="";
    for (var dia=1; dia <= diasMes;dia++){
        var indice = new Date(2021, mes - 1, dia).getDay();
        th+="<th>"+diasSemana[indice]+"</th>";
        td+="<td>"+dia+"</td>";
        
        td2+="<td>"+dtito+"</td>";
    }
    $('.fondo-table').append("<tr>"+th+"</tr");
    $('.bg-tr').append(td);
    $('#Aux').append(td2);

}