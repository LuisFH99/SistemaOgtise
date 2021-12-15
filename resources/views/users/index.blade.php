@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    <h1>Lista de Usuarios</h1>
@stop

@section('content')
    @livewire('admin.users-index')        
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    @livewireStyles 
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    @livewireScripts
    <script>
        let idp=0;
        function selecNombre(id,nombre){
            document.getElementById('exampleModalLabel').innerHTML=""+nombre;
        }
        function selectId(id){
            idp=id;
        }
    </script>
@stop
