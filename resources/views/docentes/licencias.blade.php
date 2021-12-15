@extends('adminlte::page')

@section('title', 'Licencias')

@section('content_header')
    <h1>Licencias</h1>
@stop

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 p-2">
            <div class="card h-100 fondo-cards">
                <div class="card-body">
                    <h2>Crear solicitud de Licencia:</h2>
                    <form>
                        <div class="row">
                            <div class="col-md-3">
                                <div>
                                    <p></p>
                                    <label>Solicito Licencia por el siguiente Motivo:</label>
                                </div>
                                <div class="dropdown">
                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Enfermedad
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href='#' onclick='selecMotivo(1);'>Comisión de Servicio</a>
                                        <a class="dropdown-item" href='#' onclick='selecMotivo(2);'>A cuenta de Vacaciones</a>
                                        <a class="dropdown-item" href='#' onclick='selecMotivo(3);'>Asuntos Particulares</a>
                                        <a class="dropdown-item" href='#' onclick='selecMotivo(4);'>Enfermedad</a>
                                        <a class="dropdown-item" href='#' onclick='selecMotivo(5);'>Vacaciones</a>
                                        <a class="dropdown-item" href='#' onclick='selecMotivo(6);'>Compensación</a>
                                        <a class="dropdown-item" href='#' onclick='selecMotivo(7);'>Capacitación</a>
                                        <a class="dropdown-item" href='#' onclick='selecMotivo(8);'>Gravidez</a>
                                        <a class="dropdown-item" href='#' onclick='selecMotivo(9);'>Onomástico</a>
                                        <a class="dropdown-item" href='#' onclick='selecMotivo(10);'>Sepelio y Luto</a>
                                        <a class="dropdown-item" href='#' onclick='selecMotivo(11);'>Cítas Médicas</a>
                                        <a class="dropdown-item" href='#' onclick='selecMotivo(12);'>Paternidad</a>
                                        <a class="dropdown-item" href='#' onclick='selecMotivo(13);'>Oncología</a>
                                    </div>
                                </div>
                                <br>
                                <div id="Nota">
                                    <label id="req1" name="req1">Requisitos:</label>
                                    <div id='Nota1'>
                                        <p>*  Certificado médico</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="row">
                                    <div class="col-6">
                                        <br>
                                        <div class="custom-file">
                                            <!--<input type="file" class="custom-file-input" name="file" id="file" lang="es" multiple>
                                            <label class="custom-file-label" for="file">Seleccionar Archivo</label>-->
                                            <div action="{{route('Admin.file.store')}}"  
                                                method="POST"
                                                class="dropzone" 
                                                id="my-awesome-dropzone">
                                            </div>
                                        </div>
                                        <div class="form-container">
                                            
                                            <!--<form class="dropzone" id="FormUploadFile" action="upload.php">
                                                <div class="dz-message">
                                                    <div class="icon">
                                                        <i class="fas fa-cloud-upload-alt"></i>
                                                    </div>
                                                    <h4>Suelta tus archivos aqui</h4>
                                                    <span class="note">No hay archivos seleccionados</span>
                                                </div>
                                                <div class="fallback">
                                                <input type="file" name="file" multiple></input>
                                                </div>
                                            </form>
                                            -->

                                        </div><br><br><br><br>
                                        <div>
                                            <label>Justificación</label>
                                            <textarea class="form-control" id="txtarea" rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="col-6">
                                        <div class="row">
                                            <div class="col-7">
                                                <br>
                                                <label>Me ausentare</label><br>
                                                <label>Desde: </label>
                                                <input type="date" id="desde" name="trip-start"
                                                    value="<?php echo date('Y-m-d');?>"
                                                    min="2021-11-09" max="2050-12-31"><br>
                                                <label>Hasta: </label>
                                                <input type="date" id="hasta" name="trip-start"
                                                    value="<?php echo date('Y-m-d');?>"
                                                    min="2021-11-09" max="2050-12-31">
                                            </div> 
                                            <div class="col-5">
                                                <br>
                                                <label>N° de dias: </label>
                                                <span id="dias">0 dias</span><br>
                                                <label>Fecha de Reincorporación:</label>
                                                <span id="reincorporar">Miercoles, 01/12/2021</span>
                                            </div>
                                            <div class="col-12">
                                                <br>
                                                <p class="text-danger">*Debes firmar para autenticar el documento:</p>
                                                <div class="col-12 d-flex justify-content-center">
                                                    <div class="checkbox-custom mr-4">
                                                        <label>
                                                            <input type="checkbox" id="chkDNIE">
                                                            <b></b>
                                                            <span class="font-weight-light">DNIe</span>
                                                        </label>
                                                    </div>                              
                                                    <div class="checkbox-custom">
                                                        <label>
                                                        <input type="checkbox" id="chkCodigoFirma">
                                                            <b></b>
                                                            <span class="font-weight-light">Clave de Firma Electrónica</span>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex justify-content-center">
                                                    <div class="col-8">
                                                        <label class="mt-1 text-sm-right ">Ingrese clave</label>
                                                        <div class="input-group">
                                                            <input id="txtCodigoFirma" type="Password" Class="form-control">
                                                            <div class="input-group-append">
                                                                <button style="background-color:#28AECE;border-color:#28AECE" id="show_password" class="btn btn-primary" type="button" onclick="mostrarPassword()">
                                                                    <span class="fa fa-eye-slash icon"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                        <br>
                        <button type="button" class="btn btn-primary btn-lg dr" data-toggle="modal" data-target="#exampleModal">Solicitar</button>
                    
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-14 p-2 anc">
            <div class="card fondo-cards">
                <div class="col-14 card-body ">
                    <h2>Licencias:</h2>
                    <div class="table-responsive">
                        <table class="table table-sm " id="idtablelicencia">
                            <thead>
                                <tr>
                                    <th scope="col">Código de licencia</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Hora</th>
                                    <th scope="col">Estado</th>
                                    <th scope="col">Ver</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>y7GAf5dg</td>
                                    <td>Jueves, 02/12/2021</td>
                                    <td>15:27:50</td>
                                    <td>Enviado</td>
                                    <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="far fa-eye"></i></a></td>
                                </tr>
                                <tr>
                                    <td>y7GAf5dg</td>
                                    <td>Jueves, 02/12/2021</td>
                                    <td>15:27:50</td>
                                    <td>Dpto. Académico</td>
                                    <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="far fa-eye"></i></a></td>
                                </tr>
                                <tr>
                                    <td>y7GAf5dg</td>
                                    <td>Jueves, 02/12/2021</td>
                                    <td>15:27:50</td>
                                    <td>Dpto. Académico</td>
                                    <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="far fa-eye"></i></a></td>
                                </tr>
                                <tr>
                                    <td>y7GAf5dg</td>
                                    <td>Jueves, 02/12/2021</td>
                                    <td>15:27:50</td>
                                    <td>Decanatura</td>
                                    <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="far fa-eye"></i></a></td>
                                </tr>
                                <tr>
                                    <td>y7GAf5dg</td>
                                    <td>Jueves, 02/12/2021</td>
                                    <td>15:27:50</td>
                                    <td>URyC</td>
                                    <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="far fa-eye"></i></a></td>
                                </tr>
                                <tr>
                                    <td>y7GAf5dg</td>
                                    <td>Jueves, 02/12/2021</td>
                                    <td>15:27:50</td>
                                    <td>Aprobado</td>
                                    <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="far fa-eye"></i></a></td>
                                </tr>
                                <tr>
                                    <td>y7GAf5dg</td>
                                    <td>Jueves, 02/12/2021</td>
                                    <td>15:27:50</td>
                                    <td>Desaprobado</td>
                                    <td><a href="#" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="far fa-eye"></i></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal1 -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img class="centrado" src="https://avam.es/wp-content/uploads/2020/01/icono-check.png">
                <center><h1 class="modal-title text-success" id="exampleModalLabel">Envío Exitoso</h1></center>
                <br>
                <div class="col-14 p-2 ">
                    <div class="card fondo-cards">
                        <div class="table-responsive">
                            <form action="">
                                <table class="table table-sm " id="tableCodigo">
                                    <tbody>
                                        <tr>
                                            <td>Código de solicitud</td>
                                            <td class="dr">y7GAf5dg</td>
                                        </tr>
                                        <tr>
                                            <td>Fecha de envío:</td>
                                            <td class="d">Jueves, 02/12/2021</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
                    <center><p class="text-secondary">Te hemos enviado una copia de esta constancia a tu correo electrónico</p></center>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-outline-success " data-dismiss="modal">Aceptar</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal2 -->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Licencia pedida el 06/12/21 15:27:12</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!--<div class="col-14 p-2 ">
                    <div class="card fondo-cards">
                        <div class="table-responsive">
                            <table class="table table-sm ">
                                <tbody>
                                    <tr>
                                        <td>Fecha y Hora de Petición</td>
                                        <td class="dr">Lunes, 06 de diciembre de 2021</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>-->
                        <embed src="https://www.fdi.ucm.es/profesor/jpavon/poo/01HolaMundo.pdf" frameborder="0" width="100%" height="400px">
                    <!--</div>
                </div>-->
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn-outline-danger " data-dismiss="modal">Denegar</button>-->
                <button type="button" class="btn btn-outline-primary " data-dismiss="modal">Aceptar</button>
            </div>
        </div>
    </div>
</div>    
@stop

@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="/css/style.css">
@stop

@section('js')

    <script> console.log('Hi!');</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js" integrity="sha512-oQq8uth41D+gIH/NJvSJvVB85MFk1eWpMK6glnkg6I7EdMqC1XVkW7RxLheXwmFdG03qScCM7gKS/Cx3FYt7Tg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        Dropzone.options.myAwesomeDropzone = { // camelized version of the `id`
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //'X-CSRF-TOKEN':"{{csrf_token()}}"
                //'X-CSRF-TOKEN': window.CSRF_TOKEN// <--- aquí el token
            },
            paramName: "file", // The name that will be used to transfer the file
            maxFilesize: 10, // MB
            maxFiles: 5,
            addRemoveLinks: true, // Don't show remove links on dropzone itself.
            dictDefaultMessage: "Arrastra los archivos aquí para subirlos",/*dictCancelUpload: true,//cancelar archivo al subir
            accept: function(file, done) {
            if (file.name == "justinbieber.jpg") {
                done("Naha, you don't.");
            }
            else { done(); }
            }
            
	        dictCancelUploadConfirmation: true,//confirma la cancelacion
	        dictRemoveFile: 'Remove.'*/
        };
    /*
    $(window).on("load resize", function() {
    if (this.matchMedia("(min-width: 768px)").matches) {
        $dropdown.hover(
        function() {
            const $this = $(this);
            $this.addClass(showClass);
            $this.find($dropdownToggle).attr("aria-expanded", "true");
            $this.find($dropdownMenu).addClass(showClass);
        },
        function() {
            const $this = $(this);
            $this.removeClass(showClass);
            $this.find($dropdownToggle).attr("aria-expanded", "false");
            $this.find($dropdownMenu).removeClass(showClass);
        }
        );
    } else {
        $dropdown.off("mouseenter mouseleave");
    }
    });*/
        function selecMotivo(id) {
            console.log('->'+id);
            //addElement1('label','Requerimientos', 'Nota',id); 
            switch (id) {
                case 1://comision de servicio
                    console.log('caso->'+id);
                    addElement1('p','* Con documento Sustentatorio <br>' 
                            +'* No debera exceder los 30 dias calendario', 'Nota1',id,'Comisión de Servicio');
                    break;
                case 2://a cuenta de vacaciones
                    console.log('caso->'+id);
                    addElement1('p','* Art. 110 (c) D.S. 005-90-PCM <br>'
                            +'* Por Matrimonio <br>'
                            +'* Por enfermedad Grave del Cónyuge, padres o hijos', 'Nota1',id,'A cuenta de Vacaciones');
                    break;
                case 3://Asuntos Particulares
                    console.log('caso->'+id);
                    addElement1('p','* Sin goce de haber', 'Nota1',id,'Asuntos Particulares');
                    break;
                case 4://Enfermedad
                    addElement1('p','* Certificado médico', 'Nota1',id,'Enfermedad');
                    break;
                case 5://Vacaciones
                    addElement1('p','* Ninguno', 'Nota1',id,'Vacaciones');
                    break;
                case 6://Compensación
                    addElement1('p','* Ninguno', 'Nota1',id,'Compensación');
                    break;
                case 7://Capacitación
                    addElement1('p','* Ninguno', 'Nota1',id,'Capacitación');
                    break;
                case 8://Gravidez
                    addElement1('p','* Ninguno', 'Nota1',id,'Gravidez');
                    break;
                case 9://Onomástico
                    addElement1('p','* Ninguno', 'Nota1',id,'Onomástico');
                    break;
                case 10://Sepelio y luto
                    addElement1('p','*Ninguno', 'Nota1',id,'Sepelio y Luto');
                    break;
                case 11://Citas Médicas
                    addElement1('p','*Ninguno', 'Nota1',id,'Cítas Médicas');
                    break;
                case 12://Paternidad
                    addElement1('p','* DS N°014-2010-TR (Reglamento ley N° 29409)', 'Nota1',id,'Paternidad');
                    break;
                case 13://Oncologia
                    addElement1('p','* Ley N° 30012', 'Nota1',id,'Oncología');
                    break;
                default:
                    addElement1('p','*Especifique', 'Nota1',id,'Seleccionar Motivo');
            }
        }

        function addElement1(tipo,texto, lugar,val,ele){
            document.getElementById(''+lugar).innerHTML="";
            var lbb = document.createElement(''+tipo); 
            lbb.innerHTML=''+texto;
            lbb.setAttribute('id', ''+tipo.substr(0,2)+''+val);
            document.getElementById(''+lugar).appendChild(lbb);
            document.getElementById('dropdownMenuButton').innerHTML=""+ele;
        }
        function addElement2(tipo,texto, lugar,val){
            document.getElementById(''+lugar).innerHTML="";
            var lbb = document.createElement(''+tipo); 
            lbb.appendChild(document.createTextNode(''+texto));
            lbb.setAttribute('id', ''+tipo.substr(0,2)+''+val);
        }
        function addElement3(tipo,texto, lugar,val){
            
            var lbb = document.createElement(''+tipo); 
            lbb.appendChild(document.createTextNode(''+texto));
            lbb.setAttribute('id', ''+tipo.substr(0,2)+''+val);
            document.getElementById(''+lugar).appendChild(lbb);
            // Obtener una referencia al elemento, antes de donde queremos insertar el elemento
            var sp2 = document.getElementById(''+lugar);
            // Obtener una referencia al nodo padre
            var parentDiv = sp2.parentNode;
            // Inserta un nuevo elemento en el DOM antes de sp2
            parentDiv.insertBefore(lbb, sp2.nextSibling);
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
    </script>
    <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
@stop
