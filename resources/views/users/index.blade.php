@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    <h1>Lista de Usuarios</h1>
@stop

@section('content')
@if (session('info'))
    <div class="alert alert-success">
        <strong>{{session('info')}}</strong>
    </div>
@endif
    @livewire('admin.users-index')
         
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    @livewireStyles 
@stop

@section('js')
    <script> let idp=0; console.log('Hi!'); 
    // $(function() {
    //     (idp!=0)?$('#modalEdit').modal('show');:$('#modalEdit').$('#modalEdit').modal('toggle');
    // });
    </script>
    @livewireScripts
    <script>
        
        function selecNombre(nombre){
            document.getElementById('exampleModalLabel').innerHTML=""+nombre;
        }
        function selectId(id){
            $.ajax({
                url: '/users/index/datos',
                method: 'POST',
                data: {
                    _token: $('input[name="_token"]').val(),
                    dt: id,
                }
            }).done(function(res) {
                alert(res.name);
                $('#idNombre').html(res.name);
                devolverNombres( res.id);
                $('#modalEdit').modal('show');
            }).fail(function(msg) {
                alert("error");
            });
            
            //event.preventDefault();
            //idp=id;
        }
        function devolverNombres( id){
            $.ajax({
                url: '/users/index/roles',
                method: 'POST',
                data: {
                    dt: id,
                }
            }).done(function(msg) {
                msg.id.forEach(element => {
                    // $("#selectall").on("click", function() {
                    //     $(".case").prop("checked", this.checked);
                    // });
                    alert (element);
                });
            }).fail(function(msg) {
                alert("error");
            });
        }
        function listAllProperties(o) {
            var objectToInspect;
            var result = [];

            for(objectToInspect = o; objectToInspect !== null;
                objectToInspect = Object.getPrototypeOf(objectToInspect)) {
                result = result.concat(
                    Object.getOwnPropertyNames(objectToInspect)
                );
            }

                return result;
        }
        
    </script>
@stop
