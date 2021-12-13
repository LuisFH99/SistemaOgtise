@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    <h1>Asistencia Docente</h1>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col">
                <h1>Subir imagenes</h1>
                <!--<div class="card">
                    <div class="card-body">
                        <form action="{{route('Admin.file.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <input type="file" name="file" id="">
                            </div>
                            <button type="submit" class="btn btn-primary">Subir Imagen</button>
                        </form>
                    </div>
                </div>-->
                <form action="{{route('Admin.file.store')}}"  
                    method="POST"
                    class="dropzone" 
                    id="my-awesome-dropzone">
                    
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@stop

@section('js')
    <script> console.log('Hi!'); </script>
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
            /*dictCancelUpload: true,//cancelar archivo al subir
            accept: function(file, done) {
            if (file.name == "justinbieber.jpg") {
                done("Naha, you don't.");
            }
            else { done(); }
            }
            
	        dictCancelUploadConfirmation: true,//confirma la cancelacion
	        dictRemoveFile: 'Remove.'*/
        };
    </script>
    @stop
