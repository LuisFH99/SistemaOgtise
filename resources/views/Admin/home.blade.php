@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    <h1>Asistencia Docente</h1>
@stop

@section('content')
    <p>Quizas algo se nos ocurra xd xd</p>
        <div class="dropdown">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Imágenes
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="{{route('Admin.files.index')}}">Ver Imagenes</a>
                <a class="dropdown-item" href="{{route('Admin.files.create')}}">Crear Imagen</a>
            </div>
        </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
