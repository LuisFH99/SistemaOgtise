@extends('adminlte::page')

@section('title', 'Licencias')

@section('content_header')
    <h1>Licencias</h1>
@stop

@section('content')
    <div class="container">
        <h2>Crear solicitud de Licencia:</h2>
        
            <div class="row bg-gray ">
                <div class="col-md-4 ">
                    <div>
                        <p></p>
                        <label>Solicito Licencia por el siguiente Motivo:</label>
                    </div>
                    <select class="form-select" aria-label="Seector Rol" id="cbTipoPermiso" onChange='selecMotivo(this.value);' onselect='selecMotivo(this.value);'>
                        <option >Seleccione...</option>
                        <option value="1" >Comisión de Servicio</option>
                        <option value="2" >A cuenta de vacaciones</option>
                        <option value="3" >Asuntos Particulares</option>
                        <option value="4" selected>Enfermedad</option>
                        <option value="5" >Vacaciones</option>
                        <option value="6" >compensación</option>
                        <option value="7" >Capacitación</option>
                        <option value="8" >Gravidez</option>
                        <option value="9" >Onomástico</option>
                        <option value="10" >Sepelio y Luto</option>
                        <option value="11" >Citas Médicas</option>
                        <option value="12" >Paternidad</option>
                        <option value="13" >Oncologia</option>
                        <option value="14" >Otro...</option>
                    </select>
                    <div><p></p></div>
                    <div id="Nota">
                        <label id="req1" name="req1">Requisitos:</label>
                        <div id='Nota1'>
                            <p>*  Certificado médico</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div><p></p></div>
                    
                    <div class="form-container">
                        <form class="dropzone" id="FormUploadFile" action="upload.php">
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
                        
                    </div>

                </div>
                <div class="col-md-4 ">
                    <p>Aqui las solis</p>
                </div>
                
            </div> 
        </div>    

        <div class="container">
        <h2>Licencias:</h2>
        <p>Aqui las solis</p>
        </div>  
    </div>
@stop

@section('css')
    <link href="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone.css" rel="stylesheet" type="text/css" />
    
    
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!');
        function selecMotivo(id) {
            console.log('->'+id);
            //addElement1('label','Requerimientos', 'Nota',id);
            switch (id) {
                case '1'://comision de servicio
                    console.log('caso->'+id);
                    addElement1('p','* Con documento Sustentatorio <br>' 
                            +'* No debera exceder los 30 dias calendario', 'Nota1',id);
                    break;
                case '2'://a cuenta de vacaciones
                    console.log('caso->'+id);
                    addElement1('p','* Art. 110 (c) D.S. 005-90-PCM <br>'
                            +'* Por Matrimonio <br>'
                            +'* Por enfermedad Grave del Cónyuge, padres o hijos', 'Nota1',id);
                    break;
                case '3'://Asuntos Particulares
                    console.log('caso->'+id);
                    addElement1('p','* Sin goce de haber', 'Nota1',id);
                    break;
                case '4'://Enfermedad
                    addElement1('p','* Certificado médico', 'Nota1',id);
                    break;
                case '5'://Vacaciones
                    addElement1('p','* Ninguno', 'Nota1',id);
                    break;
                case '6'://Compensación
                    addElement1('p','* Ninguno', 'Nota1',id);
                    break;
                case '7'://Capacitación
                    addElement1('p','* Ninguno', 'Nota1',id);
                    break;
                case '8'://Gravidez
                    addElement1('p','* Ninguno', 'Nota1',id);
                    break;
                case '9'://Onomástico
                    addElement1('p','* Ninguno', 'Nota1',id);
                    break;
                case '10'://Sepelio y luto
                    addElement1('p','*Ninguno', 'Nota1',id);
                    break;
                case '11'://Citas Médicas
                    addElement1('p','*Ninguno', 'Nota1',id);
                    break;
                case '12'://Paternidad
                    addElement1('p','* DS N°014-2010-TR (Reglamento ley N° 29409)', 'Nota1',id);
                    break;
                case '13'://Oncologia
                    addElement1('p','* Ley N° 30012', 'Nota1',id);
                    break;
                default:
                    addElement1('p','*Ninguno', 'Nota1',id);
            }
        }

        function addElement1(tipo,texto, lugar,val){
            document.getElementById(''+lugar).innerHTML="";
            var lbb = document.createElement(''+tipo); 
            lbb.innerHTML=''+texto;
            lbb.setAttribute('id', ''+tipo.substr(0,2)+''+val);
            document.getElementById(''+lugar).appendChild(lbb);
        }
        function addElement2(tipo,texto, lugar,val){
            document.getElementById(''+lugar).innerHTML="";
            var lbb = document.createElement(''+tipo); 
            lbb.appendChild(document.createTextNode(''+texto));
            lbb.setAttribute('id', ''+tipo.substr(0,2)+''+val);
            document.getElementById(''+lugar).appendChild(lbb);
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
    </script>
    <script src="https://unpkg.com/dropzone@6.0.0-beta.1/dist/dropzone-min.js"></script>
@stop
