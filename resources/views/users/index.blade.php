@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    <h1>Usuarios</h1>
@stop

@section('content')
@if (session('info'))
    <div class="alert alert-success">
        <strong>{{session('info')}}</strong>
    </div>
@endif
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <div class="card-body">
                        <form action="{{ route('docentes.store') }}" method="POST">
                            <div class="col-12">
                                @csrf
                                <div class="row">
                                    <div class="col-md-2 col-sm-6">
                                        <label class="form-label">DNI:</label>
                                        <input type="text" class="form-control" id="dni" name="dni" placeholder="Ingrese el N° DNI" tabindex="1">
                                    </div>
                                    <div class="col-md-2 col-sm-6">
                                        <label class="form-label">Apellidos Paterno:</label>
                                        <input type="text" id="apepat" name="apepat" class="form-control" placeholder="" tabindex="2">
                                    </div>
                                    <div class="col-md-2 col-sm-6">
                                        <label class="form-label">Apellidos Materno:</label>
                                        <input type="text" id="apemat" name="apemat" class="form-control" placeholder="" tabindex="3">
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <label class="form-label">Nombres:</label>
                                        <input type="text" id="nombres" name="nombres" class="form-control" placeholder="" tabindex="4">
                                    </div>
                                    <div class="col-md-3 col-sm-6">
                                        <label class="form-label">Fecha de Nacimiento</label>
                                        <input type="date" id="fnacimiento" name="fnacimiento" class="form-control" tabindex="5">
                                    </div>
                                    <div class="col-md-3 col-sm-6 my-3">
                                        <label class="form-label">Celular:</label>
                                        <input type="text" id="numcel" name="numcel" class="form-control" placeholder="Ingrese N° celular"
                                            tabindex="6">
                                    </div>
                                    <div class="col-md-3 col-sm-6 my-3">
                                        <label class="form-label">Correo Institucional:</label>
                                        <input type="email" id="email" name="email" class="form-control" placeholder="correo@unasam.edu.pe"
                                            tabindex="7">
                                    </div>
                                    {{-- <div class="col-md-3 col-sm-6 my-3">
                                        <label class="form-label">Facultad:</label>
                                        <div class="input-group">
                                            <select wire:model="selectFacultad" id="facultad" name="facultad" class="form-control" tabindex="8">
                                                <option>Seleccione...</option>
                                                @foreach ($facultades as $facultad)
                                                    <option value="{{ $facultad->id_Facultades }}">{{ $facultad->nomFac }}</option>
                                                @endforeach
                                            </select>
                                            <div class="input-group-append">
                                                <button id="addfacultad" class="btn btn-primary" type="button"><span class="fa fa-plus"></span>
                                            </div>
                                        </div>
                                    </div> --}}
                                
                                    <div class="col-12 mx-auto">
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary pull-right" href="#">Crear Usuarios</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div><br>
    <div >
        <p class="h5">Lista de Usuarios:</p>
    </div>
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
