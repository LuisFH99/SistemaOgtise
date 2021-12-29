//Dropzone
Dropzone.options.myAwesomeDropzone = { // camelized version of the `id`
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    autoProcessQueue: false,
    paramName: "file", // The name that will be used to transfer the file
    maxFilesize: 10, // MB
    maxFiles: 3,
    addRemoveLinks: false, // Don't show remove links on dropzone itself.
    dictDefaultMessage: "Arrastra los archivos aquí para subirlos",

    init: function() {
        var submitButton = document.querySelector("#btnenviar");
        var wrapperThis = this;

        submitButton.addEventListener("click", function() {
            wrapperThis.processQueue();
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
            formData.append("idMot", idMot);
        });
    }

};



$(function() {
    
    let txt = formatoFecha($('#dtofecha').val());
    $('#fecha').text(txt);

    if($('#aux').val()==2){
        CapturarDocente();
    }
    //selectanio(new Date().getFullYear());

    $('#chkCodigoFirma').prop("checked",false);
    $('#chkDNIE').prop("checked",false);

    IncioRep(new Date().getMonth()+1,new Date().getFullYear());

    $('#meses').on('change',function(){
        RegistroMensual($(this).val(),$('#selectyyyy').val());
    });
    $('#selectyyyy').on('change',function(){
        RegistroMensual($('#meses').val(),$(this).val());
    });



    // $("#meses option[value="+ new Date().getMonth()+1 +"]").attr("selected",true);
    

    MostarFirma();

    $('#Guardar').on('click',function(){
        //document.getElementById("btnenviar").click();
        if($('#txtCodigoFirma').val().trim != ''){
            $.ajax({
                url: '/docentes/salida/registrar', 
                method: 'POST',
                data: {
                    _token: $('input[name="_token"]').val(),
                    firma: $('#txtCodigoFirma').val(),
                    fecha:$('#dtofecha').val(),
                    hora:$('#dtohora').val(),
                    iddoc:$('#docente').val(),
                    actividad: $('#actividad').val()     
                }
            }).done(function(res) {
                
                if(res==1){
                 document.getElementById("btnenviar").click();
                 Swal.fire({
                    title: 'Se registro su Salida',
                    text: "Datos enviados!",
                    icon: 'success',
                    confirmButtonColor: '#3085d6',          
                    confirmButtonText: 'Perfecto!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    }
                  })
                }else{
                 Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Clave no Valida'
                })
                
            }
            }).fail(function() {
                Swal.fire('Falla en la envio de Datos', '', 'error');
            });
        }else{
            Swal.fire('Falta Actividad Realizada', '', 'error');
        }
       
    });
   
});




//funciones
function formatoFecha(dato) {
    dato = dato.toString();
    date = new Date(dato);
    const months = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre",
        "Octubre", "Noviembre", "Diciembre"
    ];
    const days = ["Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado", "Domingo"];
    let fecha = dato.split("-");
    let formatted_date = days[date.getDay()] + ", " + fecha[2] + " de " + months[parseInt(fecha[1]) - 1] + " de " +
        date.getFullYear();
    return formatted_date;
}

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
        $('.fa-camera').on('click',function(){
            canvas.getContext('2d').drawImage(video, 0, 0, video.videoWidth, video.videoHeight,0, 0, 198, 150);
             //var data = canvas.toDataURL('image/png');
        });

        $('#grabar').click(function() {
            //canvas.getContext('2d').drawImage(video, 0, 0, video.videoWidth, video.videoHeight,0, 0, 198, 150);
             var data = canvas.toDataURL('image/png');
             Swal.fire({
                title: 'Confirme el registro de su Asistencia',
                //text: 'Verifique antes, si ya registro su asistencia con el tema correspondiente!',
                showDenyButton: true,
                confirmButtonText: `Confirmar Asistencia`,
                denyButtonText: `Cancelar`,
                customClass: 'swal-wide',
            }).then((result) => {
                /* Read more about isConfirmed, isDenied below */
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/docentes/entrada/registrar',
                        method: 'POST',
                        data: {
                            _token: $('input[name="_token"]').val(),
                            firma: $('#txtCodigoFirma').val(),
                            fecha:$('#dtofecha').val(),
                            hora:$('#dtohora').val(),
                            iddoc:$('#docente').val(),
                            caso:1,
                            foto: data      
                        }
                    }).done(function(res) {
                        if(res==1){
                         Swal.fire('Asistencia Registrada', '', 'success');
                         location.reload();
                        }else{
                         Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Clave no Valida'
                        })
                        
                    }
                    }).fail(function() {
                        Swal.fire('Falla en la envio de Datos', '', 'error');
                    });
                    
                } else if (result.isDenied) {
                    Swal.fire('No se realizó ningún cambio', '', 'info')
                }
            })
            
        });
    }
}).catch((err) => {
    $('#grabar').click(function() {
        Swal.fire({
            title: 'Confirme el registro de su Asistencia',
            //text: 'Verifique antes, si ya registro su asistencia con el tema correspondiente!',
            showDenyButton: true,
            confirmButtonText: `Confirmar Asistencia`,
            denyButtonText: `Cancelar`,
            customClass: 'swal-wide',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                $.ajax({
                    url: '/docentes/entrada/registrar',
                    method: 'POST',
                    data: {
                        _token: $('input[name="_token"]').val(),
                        firma: $('#txtCodigoFirma').val(),
                        fecha:$('#dtofecha').val(),
                        hora:$('#dtohora').val(),
                        iddoc:$('#docente').val(),
                        caso:2    
                    }
                }).done(function(res) {
                    if(res==1){
                     Swal.fire('Asistencia Registrada', '', 'success');
                     location.reload();
                    }else{
                     Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Clave no Valida'
                    })
                    
                }
                }).fail(function() {
                    Swal.fire('Falla en la envio de Datos', '', 'error');
                });
                
            } else if (result.isDenied) {
                Swal.fire('No se realizó ningún cambio', '', 'info')
            }
        })
    });
})
}

function limpiar(){
    $("#table th").remove();
    $("#table td").remove();   
}

function selectanio(dto){
    for (let i = 0; i < 4; i++) {
        $('#selectyyyy').append($("<option>", {
            value: dto - i,
            text: dto - i
        }));
    }
}

function IncioRep(dto1,dto2){
    selectanio(dto2);
    $("#meses option[value="+ dto1 +"]").attr("selected",true);
    RegistroMensual(dto1,dto2);

}

//let th=""; let td=""; let td2="";

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

  

function AbrirModal(dto,dia) {
    switch (dto) {
        case '1':
            ModalAsistio(dia);
            break;
        case '2':
            ModalFalto(dia);
            break;
        /*case '3':
            ModalJusticado(dia);
            break;
        case '4':
            ModalLicencia(dia);
            break;*/
    }
}

function ModalAsistio(dia) {

    $.ajax({
        url: '/docentes/registros/asistencia/Detalle',
        method: 'POST',
        data: {
            _token: $('input[name="_token"]').val(),
            dia: dia,
            mes: $('#meses').val(),
            year: $('#selectyyyy').val()
        }
    }).done(function(res) {
        console.log(res);
        $('#tituloModal').text('Detalle Registro de Asistencia');
        $('#Asistencia').css('display', 'block');
        $('#Jusficacion').css('display', 'none');
        $('#AsisteciaModal').modal('show');
        
        $('#fechreg').text('Fecha de Registro: '+formatoFecha(res.fecha));
        $('#entrada').text('Hora de Entrada: '+res.hor_entrada);
        $('#salida').text('Hora de Salida: '+res.hor_salida);
        $('#actividad').text(''+res.informe);
        $('#foto').attr("src",res.URL_foto);
        $('#tkentrada').text('Codigo de Registro de Entrada: '+res.tkentrada);
        $('#tksalida').text('Codigo de Registro de Salida: '+res.tksalida);
       
    }).fail(function() {
        Swal.fire('Falla en la envio de Datos', '', 'error');
    });
    
    
}

function ModalFalto(dia) {
    /*$('#tituloModal').text('Justificar Falta');
    $('#Jusficacion').css('display', 'block');
    $('#Asistencia').css('display', 'none');
    $('#AsisteciaModal').modal('show');*/
    $(location).attr('href','/docentes/licencias');
}

function ModalJusticado() {
    $('#tituloModal').text('Detalle de Justificación');
    $('#AsisteciaModal').modal('show');
}

function ModalLicencia() {
    $('#tituloModal').text('Detalle de Licencia');
    $('#AsisteciaModal').modal('show');
}


function RegistroMensual(mes,aa){
    $.ajax({
        url: '/docentes/registros/asistencia/All',
        method: 'POST',
        data: {
            _token: $('input[name="_token"]').val(),
            mes: mes,
            year: aa
        }
    }).done(function(res) {
        limpiar();
        let th=""; let td=""; let td2="";
        //let dtito="<img src='/vendor/adminlte/dist/img/asistio.svg' onclick=AbrirModal('a')>";
        var diasMes = new Date(2021, mes, 0).getDate();
        var diasSemana = ['D0', 'LU', 'MA', 'MI', 'JU', 'VI', 'SA'];
        console.log(res);

        if(res.length > 0){
            for (var dia=1; dia <= diasMes;dia++){
            var indice = new Date(2021, mes - 1, dia).getDay();
            th+="<th>"+diasSemana[indice]+"</th>";
            td+="<td>"+dia+"</td>";
            let dto = res.find(fecha => fecha.dia == dia);
                if(dto == undefined){
                    td2+="<td><img src='/vendor/adminlte/dist/img/libre.svg'></td>";
                }else{
                    td2+="<td><img src='/vendor/adminlte/dist/img/"+dto.estado+".svg' onclick=AbrirModal('"+dto.estado+"','"+dto.dia+"')></td>";
                }
            }
            
        }else{
            for (var dia=1; dia <= diasMes;dia++){
                var indice = new Date(2021, mes - 1, dia).getDay();
                th+="<th>"+diasSemana[indice]+"</th>";
                td+="<td>"+dia+"</td>";
                td2+="<td><img src='/vendor/adminlte/dist/img/libre.svg'></td>";
            }
        }
        $('.fondo-table').append("<tr>"+th+"</tr");
        $('.bg-tr').append(td);
        $('#Aux').append(td2);
    }).fail(function() {
        Swal.fire('Falla en la envio de Datos', '', 'error');
    });

    
    // let th=""; let td="";
    /*for (var dia=1; dia <= diasMes;dia++){
        var indice = new Date(2021, mes - 1, dia).getDay();
        th+="<th>"+diasSemana[indice]+"</th>";
        td+="<td>"+dia+"</td>";
        
        td2+="<td>"+dtito+"</td>";
    }
    $('.fondo-table').append("<tr>"+th+"</tr");
    $('.bg-tr').append(td);
    $('#Aux').append(td2);*/

}