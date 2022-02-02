@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    <h1>Mi Perfil</h1>
@stop

@section('content')

        <div class="card">
            <div class="card-body">
                <div>
                    <p class="h5 mr-1"> <b>{{$user->name}}</b></p>
                </div>
            </div>
            <div class="card-body">
                <div class="col-md-8">
                    @if (session('info'))
                        <div class="alert alert-success">
                            <strong>{{session('info')}}</strong>
                        </div>
                    @endif
                    @if (session('info1'))
                        <div class="alert alert-danger">
                            <strong>{{session('info1')}}</strong>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-header">{{ __('Cambiar Contraseña') }}</div>
        
                        <div class="card-body">
                            
                            {!! Form::open(['route' => ['perfiles.store'],'method'=>'post']) !!}
                                <div class="form-group">
                                    <div class="row mb-3">
                                        {!! Form::label('Contraseña Anterior', null, ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                                        <div class="col-md-6">
                                            {!! Form::password('passwordA', ['class' => 'form-control']) !!}
                                            @error('passwordA')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
        
                                <div class="form-group">
                                    <div class="row mb-3">
                                        {!! Form::label('Nueva Contraseña', null, ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                                        <div class="col-md-6">
                                            {!! Form::password('passwordN', ['class' => 'form-control']) !!}
                                            @error('passwordN')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="row mb-3">
                                        {!! Form::label('Confirmar Contraseña', null, ['class' => 'col-md-4 col-form-label text-md-right']) !!}
                                        <div class="col-md-6">
                                            {!! Form::password('passwordC', ['class' => 'form-control']) !!}
                                            @error('passwordC')
                                                <small class="text-danger">{{$message}}</small>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
        
                                <div class="row mb-0">
                                    <div class="col-md-6 offset-md-4">
                                        {!! Form::button('<i class="fas fa-lock"></i> Cambiar Contraseña', ['type' => 'submit', 'class' => 'btn btn-primary'] ) !!}
                                    </div>
                                </div>
                                {!! Form::close() !!}   
                        </div>
                    </div>
                </div>
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
    <script>
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
