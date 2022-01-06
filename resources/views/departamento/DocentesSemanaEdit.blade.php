@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    <h1>Asignar Dias Laborables</h1>
@stop

@section('content')

        <div class="card">
            <div class="card-body">
                <p class="h5">Nombre:</p>
                {{-- @if ($Persona->count()) --}}
                    <p class="form-control">{{$Persona->apellPat.' '.$Persona->apellMat.' '.$Persona->nombres}}</p>  
                {{--@else
                    <div class="card-body">
                        <strong>No hay Nombre</strong>
                    </div>
                @endif --}}
                
                <h5>Listado de dias de la semana:</h5>
                {!! Form::model($DetSemanas,['url' => '/departamento/docentes/updateSemana/'.$Persona->idDocentes.'','method'=>'put']) !!}
                    
                    @foreach ($Semanas as $Semana)
                        <div>
                            <label>
                                {{-- {!! Form::checkbox('cbox'.$Semana->idSemanas, $Semana->idSemanas, null, ['class'=>'mr-1']) !!} --}}
                                <input type="checkbox" name='cbox{{$Semana->idSemanas}}' id='cbox{{$Semana->idSemanas}}' value="{{$Semana->idSemanas}}">
                                {{$Semana->dia}}
                            </label>
                        </div>
                    @endforeach
                    {!! Form::submit('Asignar Dia', ['class'=>'btn btn-primary mt-2']) !!}                
                {!! Form::close() !!}
            </div>
        </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    @livewireStyles 
@stop

@section('js')
    <script> console.log('Hi!'); 
    $(function() {
        marcarSemana();
        //$('#chkDNIE').prop("checked", false);    
    });
function marcarSemana(){
    let datos="{{$msg}}";
    let array=datos.split(',');
    array.shift();
    array.forEach(element => {
        for (let i = 1; i <= 5; i++) {
            let dt=$("#cbox"+i).val();
            console.log(element+"-"+dt);
            if(dt===element){
                $("#cbox"+i).prop("checked", true); 
            }
        }
    });
}
    </script>

    @livewireScripts
@stop
