@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    <h1>Gestion de Usuarios y Roles</h1>
@stop

@section('content')

        <div class="card">
            <div class="card-body">
                {{-- <p class="h5">Nombre:</p>
                <p class="form-control">{{$user->name}}</p> --}}
                @livewire('admin.users-edit',['user1'=>$user->id]) 
                       
                {{-- <h5>Listado de Roles:</h5>
                {!! Form::model($user,['route' => ['Admin.users.update',$user],'method'=>'put']) !!}
                    @foreach ($roles as $role)
                        <div>
                            <label>
                                {!! Form::checkbox('roles[]', $role->id, null, ['class'=>'mr-1']) !!}
                                {{$role->name}}
                            </label>
                        </div>
                    @endforeach
                    {!! Form::submit('Asignar Rol', ['class'=>'btn btn-primary mt-2']) !!}                
                {!! Form::close() !!} --}}
            </div>
        </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="/css/style.css">
    <link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
    @livewireStyles 
@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
    <script> console.log('Hi!');
        $(function() {
            $('#toggle-state').change(function() {
                if(document.getElementById('toggle-state').checked){
                    $("#divEdit").removeClass("d-flex");
                    $("#divEdit").addClass("d-none");
                    $("input[name='bdr']").val('0');
                }else{
                    $("#divEdit").removeClass("d-none");
                    $("#divEdit").addClass("d-flex");
                    $("input[name='bdr']").val('1');
                }
            })
        })
        function SoloNumeros(e){
            var key= Window.Event? e.which : e.keyCode;
            if (key < 48 || key > 57) { 
                e.preventDefault();
            }
        };
    </script>
    @livewireScripts
@stop
