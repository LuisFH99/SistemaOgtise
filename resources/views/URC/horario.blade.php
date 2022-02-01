@extends('adminlte::page')

@section('title', 'URC | Horario')

@section('content_header')
    <h1><strong> Designar Horario</strong></h1>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card fondo-cards">
                    <div class="card-body">
                        
                        <form action="{{route('horario.update')}}" method="POST">
                            @csrf
                            <div class="row">

                                <div class="col-md-5">
                                    <h4 class="text-center">Horario de Registro de Entrada</h4>

                                    <label for="entradadesde">Desde:</label>
                                    <input type="time" name="entradadesde" class="form-control col-5" step="2" value="{{$horario->ini_entrada}}">
                                    <label for="entradahasta">Hasta:</label>
                                    <input type="time" name="entradahasta" class="form-control col-5" step="2" value="{{$horario->fin_entrada}}">
                                </div>
                                <div class="col-md-5">
                                    <h4 class="text-center">Horario de Registro de Salida</h4>
                                    <label for="salidadesde">Desde:</label>
                                    <input type="time" name="salidadesde" class="form-control col-5" step="2" value="{{$horario->ini_salida}}">
                                    <label for="salidahasta">Hasta:</label>
                                    <input type="time" name="salidahasta" class="form-control col-5" step="2" value="{{$horario->fin_salida}}">
                                </div>
                                <div class="col-md-2 my-auto">
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary mb-4">Guardar</button>
                                        <a href="{{ route('horario') }}" class="btn btn-secondary">Cancelar</a>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/style.css">
@stop

@section('js')

@stop
