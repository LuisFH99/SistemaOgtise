<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Parte Diario</title>
    <style>
        @page { margin: 0px 0px; }
        /* #header { position: fixed; left: 0px; top: -180px; right: 0px; height: 150px; background-color: orange; text-align: center; } */
        /* #header {
            position: fixed;
            left: 0px; 
            top: -180px;
            height: 150px;
            text-align: center;
            background-color: red;
        } */

        body{
            margin-top: 2.5cm;
            margin-left: 2cm;
            margin-right: 2cm;
            margin-bottom: 2cm;
        }

        .header{
            position: fixed;
            top: 0.2cm;
            left: 0cm;
            right: 0cm;
            /* height: 2cm; */
            text-align: center;
            /* border: 1px solid #000; */
        }
        

        #titulo {
            text-align: center;
            /* background-color: blue; */
            /* margin-top: 100px; */
        }
        #tableIden{
            width: 100%;
        }
        #tableIden th, #tableIden td{
            text-align: center;
        }

        #table {
            border-collapse: collapse;
            width: 100%;
        }

        #table td,
        #table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #table th {
            padding-top: 3px;
            padding-bottom: 3px;
            /* text-emphasis: left; */
            background-color: #4CAF50;
            color: #ffff;
            font-size: 13px;
        }

        #table td {
            font-size: 12px;


        }

        .page_break {
            page-break-before: always;
        }

    </style>
</head>

<body>

    <div class="header">
        <img src="Uploads/Frame.jpg" alt="">
    </div>
        @php
        $aux="";
        @endphp
        @foreach ($datos as $dato)     
            @if (json_decode($dato->departamentos) != null)
                @foreach (json_decode($dato->departamentos) as $departamento)
                    
                    <div class="{{$aux}}">
                    <h3 id="titulo">Parte Diario de Asistencia</h3>
                    @php
                        $aux="page_break";
                    @endphp
                    <table id="tableIden">
                        <thead>
                            <tr>
                                <th>Facultad:</th>
                                <th>Departamento Academico:</th>
                                <th>Fecha:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $dato->nomfac }}</td>
                                <td>{{ $departamento->dep }}</td>
                                <td>{{$fecha}}</td>
                            </tr>
                        </tbody>
                    </table>
                    <br>
                    <table id="table">
                        <thead>
                            <tr>
                                <th rowspan="2">N°</th>
                                <th rowspan="2">Apellidos y Nombres</th>
                                <th rowspan="2">CAT</th>
                                <th colspan="3">Entrada</th>
                                <th colspan="2">Salida</th>
            
                            </tr>
                            <tr>
                                <th>Foto</th>
                                <th>Hora</th>
                                <th>Firma</th>
                                <th>Hora</th>
                                <th>Firma</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $cont=1;
                            @endphp
                    @if ($departamento->docentes != null)
                        @foreach ($departamento->docentes as $docente)                            
                            @if ($docente->datoasistencias != null)
                                @foreach ($docente->datoasistencias as $asistencia)
                                    @switch($asistencia->estado)
                                        @case(1)
                                            <tr>
                                                <td scope="row" style="text-align: center">{{$cont++}}</td>
                                                <td>{{ $docente->nombres }}</td>
                                                <td style="text-align: ce nter">{{strtoupper(substr($docente->condicion, 0, 1).'-'.substr($docente->categoria, ($docente->categoria=='Auxiliar')?2:0,1)).substr($docente->dedicacion, 0, 1).substr(strstr($docente->dedicacion, ' '), 1, 1)}}</td>
                                                <td style="text-align: center"> <img src=".{{$asistencia->foto}}" width="55"> </td>
                                                <td style="text-align: center">{{ substr($asistencia->entrada,0,8) }}</td>
                                                <td style="font-size: 6px"> <p style="display: inline"> Firmado por:{{ $docente->nombres }} </p><br>
                                                    <p style="display: inline"> DNI:{{ $docente->dni }} </p><br>
                                                    <p style="display: inline">Motivo: Registro asistencia</p><br>
                                                    <p style="display: inline">{{ $asistencia->firmae }}</p><br>
                                                    <p style="display: inline">{{ $asistencia->tkentrada }}</p> </td>
                                                @if (substr($asistencia->salida,0,8) != "00:00:00")
                                                    <td style="text-align: center">{{ substr($asistencia->salida,0,8) }}</td>
                                                    <td style="font-size: 6px"><p style="display: inline"> Firmado por:{{ $docente->nombres }} </p>
                                                    <p style="display: inline"> DNI:{{ $docente->dni }} </p><br>
                                                    <p style="display: inline">Motivo: Registro asistencia</p><br>
                                                    <p style="display: inline">{{ $asistencia->firmas }}</p><br>
                                                    <p style="display: inline">{{ $asistencia->tksalida }}</p></td>
                                                @else
                                                    <td colspan="2">No hay registro</td>
                                                @endif     
                                                
                                            </tr>
                                            @break
                                        @case(2)
                                            <tr>
                                                <td scope="row">{{$cont++}}</td>
                                                <td>{{ $docente->nombres }}</td>
                                                <td>{{strtoupper(substr($docente->condicion, 0, 1).'-'.substr($docente->categoria, ($docente->categoria=='Auxiliar')?2:0,1)).substr($docente->dedicacion, 0, 1).substr(strstr($docente->dedicacion, ' '), 1, 1)}}</td>
                                                <td colspan="5">No Registro su Asistencia</td>
                                            </tr>
                                            @break
                                        @case(4)
                                            <tr>
                                                <td scope="row">{{$cont++}}</td>
                                                <td>{{ $docente->nombres }}</td>
                                                <td>{{strtoupper(substr($docente->condicion, 0, 1).'-'.substr($docente->categoria, ($docente->categoria=='Auxiliar')?2:0,1)).substr($docente->dedicacion, 0, 1).substr(strstr($docente->dedicacion, ' '), 1, 1)}}</td>
                                                <td colspan="5">Licencia Aprobada</td>
                                            </tr>
                                            @break
                                        @case(5)
                                            <tr>
                                                <td scope="row">{{$cont++}}</td>
                                                <td>{{ $docente->nombres }}</td>
                                                <td>{{strtoupper(substr($docente->condicion, 0, 1).'-'.substr($docente->categoria, ($docente->categoria=='Auxiliar')?2:0,1)).substr($docente->dedicacion, 0, 1).substr(strstr($docente->dedicacion, ' '), 1, 1)}}</td>
                                                <td colspan="5">Dia Laborable</td>
                                            </tr>
                                            @break
                                        @default
                                            
                                    @endswitch
                                        {{-- @if(substr($asistencia->entrada,0,8) != "00:00:00")
                                            <tr>
                                                <td scope="row" style="text-align: center">{{$cont++}}</td>
                                                <td>{{ $docente->nombres }}</td>
                                                <td style="text-align: ce nter">{{strtoupper(substr($docente->categoria, ($docente->categoria=='Auxiliar')?2:0,1)).substr($docente->dedicacion, 0, 1).substr(strstr($docente->dedicacion, ' '), 1, 1)}}</td>
                                                <td style="text-align: center"> <img src=".{{$asistencia->foto}}" width="55"> </td>
                                                <td style="text-align: center">{{ substr($asistencia->entrada,0,8) }}</td>
                                                <td style="font-size: 6px"> <p style="display: inline"> Firmado por:{{ $docente->nombres }} </p><br>
                                                    <p style="display: inline"> DNI:{{ $docente->dni }} </p><br>
                                                    <p style="display: inline">Motivo: Registro asistencia</p><br>
                                                    <p style="display: inline">{{ $asistencia->firmae }}</p><br>
                                                    <p style="display: inline">{{ $asistencia->tkentrada }}</p> </td>
                                                @if (substr($asistencia->salida,0,8) != "00:00:00")
                                                    <td style="text-align: center">{{ substr($asistencia->salida,0,8) }}</td>
                                                    <td style="font-size: 6px"><p style="display: inline"> Firmado por:{{ $docente->nombres }} </p>
                                                    <p style="display: inline"> DNI:{{ $docente->dni }} </p><br>
                                                    <p style="display: inline">Motivo: Registro asistencia</p><br>
                                                    <p style="display: inline">{{ $asistencia->firmas }}</p><br>
                                                    <p style="display: inline">{{ $asistencia->tksalida }}</p></td>
                                                @else
                                                    <td colspan="2">No hay registro</td>
                                                @endif     
                                                
                                            </tr>
                                        @else
                                            <tr>
                                                <td scope="row">{{$cont++}}</td>
                                                <td>{{ $docente->nombres }}</td>
                                                <td>{{strtoupper(substr($docente->categoria, ($docente->categoria=='Auxiliar')?2:0,1)).substr($docente->dedicacion, 0, 1).substr(strstr($docente->dedicacion, ' '), 1, 1)}}</td>
                                                <td colspan="5">No Registro su Asistencia</td>
                                            </tr>
                                        @endif --}}
                                @endforeach

                            @else
                                    <tr>
                                        <td scope="row">{{$cont++}}</td>
                                        <td>{{ $docente->nombres }}</td>
                                        <td>{{strtoupper(substr($docente->condicion, 0, 1).'-'.substr($docente->categoria, ($docente->categoria=='Auxiliar')?2:0,1)).substr($docente->dedicacion, 0, 1).substr(strstr($docente->dedicacion, ' '), 1, 1)}}</td>
                                        <td colspan="5">Puede que tenga un Cargo o no Trabaje ese dia</td>

                                    </tr>
                            @endif
                            
                        @endforeach
                        </tbody>
                        </table>
                    @else
                            <tr>
                                <td colspan="8">No existen Docentes Registrados</td>
                            </tr>
                        </tbody>
                        </table>

                    @endif
                @endforeach
                </div>
            @else
                <h3 id="titulo">Parte Diario de Asistencia</h3>
                <h5>No hyay deptos</h5>
            @endif
        @endforeach
</body>
</html>
