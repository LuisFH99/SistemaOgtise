@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    {{-- <h1>Asistencia Docente</h1> --}}
@stop

@section('content')
    {{-- <p>Quizas algo se nos ocurra xd xd</p> --}}
        {{-- <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Imágenes
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="{{route('Admin.files.index')}}">Ver Imagenes</a>
                <a class="dropdown-item" href="{{route('Admin.files.create')}}">Crear Imagen</a>
            </div>
        </div> --}}
    <br><br>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <div>
                            <embed src="https://cloudfront-us-east-1.images.arcpublishing.com/gruporepublica/CDMSJIKNRVGW7HOTRPZEGKCUUA.jpg" frameborder="0" width="100%" height="400px">
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="d-flex abs-center">
                            <h1>
                                Bienvenidos al Sistema de Gestion de Asistencia Docente
                            </h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
