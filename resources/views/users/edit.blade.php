@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    <h1>Asignar Roles</h1>
@stop

@section('content')

        <div class="card">
            <div class="card-body">
                <p class="h5">Nombre:</p>
                <p class="form-control">{{$user->name}}</p>
                <h5>Listado de Roles:</h5>
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
                {!! Form::close() !!}
            </div>
        </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    @livewireStyles 
@stop

@section('js')
    <script> console.log('Hi!'); </script>
    @livewireScripts
@stop
