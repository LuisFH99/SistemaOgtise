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
            background-color: blue;
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
    {{-- <div id="header">
        <img src="Uploads/Frame.jpg" alt="">
    </div> --}}
    <div class="header">
        <img src="Uploads/Frame.jpg" alt="">
        {{-- hola --}}
    </div>

    {{-- <div> --}}
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
                                <td>17/02/2021</td>
                            </tr>
                        </tbody>
                    </table>
                    
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
                            {{-- <table id="table">
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
                            </thead> --}}
                            
                            {{-- {{ $docente->nombres }} <br> --}}
                            
                            @if ($docente->datoasistencias != null)
                                @foreach ($docente->datoasistencias as $asistencia)
                                
                                    {{-- <tbody> --}}
                                        <tr>
                                            <td scope="row">{{$cont++}}</td>
                                            <td>{{ $docente->nombres }}</td>
                                            <td>{{strtoupper(substr($docente->categoria, ($docente->categoria=='Auxiliar')?2:0,1)).substr($docente->dedicacion, 0, 1).substr(strstr($docente->dedicacion, ' '), 1, 1)}}</td>
                                            <td>Otto</td>
                                            <td>{{ $asistencia->entrada }}</td>
                                            <td>{{ $asistencia->firmae }}</td>
                                            <td>{{ $asistencia->salida }}</td>
                                            <td>{{ $asistencia->firmas }}</td>
                                        </tr>
                                    {{-- </tbody> --}}
                                    
                                    {{-- {{ $asistencia->tkentrada }} <br>
                                    {{ $asistencia->tksalida }} <br> --}}
                                @endforeach
                                {{-- </tbody>
                                </table> --}}
                            @else
                                {{-- <h5>No hay Registro de Asistenica</h5> --}}
                                {{-- <tbody> --}}
                                    <tr>
                                        <td scope="row">{{$cont++}}</td>
                                        <td>{{ $docente->nombres }}</td>
                                        <td>{{strtoupper(substr($docente->categoria, ($docente->categoria=='Auxiliar')?2:0,1)).substr($docente->dedicacion, 0, 1).substr(strstr($docente->dedicacion, ' '), 1, 1)}}</td>
                                        <td colspan="5">No hay Registro de Asistenica</td>
                                        {{-- <td>{{ $asistencia->entrada }}</td>
                                        <td>{{ $asistencia->firmae }}</td>
                                        <td>{{ $asistencia->salida }}</td>
                                        <td>{{ $asistencia->firmas }}</td> --}}
                                    </tr>
                            @endif
                            
                        @endforeach
                        </tbody>
                        </table>
                    @else
                        {{-- <tbody> --}}
                            <tr>
                                <td colspan="8">No existen Docentes Registrados</td>
                                {{-- <td>{{ $docente->nombres }}</td>
                                <td>{{strtoupper(substr($docente->categoria, ($docente->categoria=='Auxiliar')?2:0,1)).substr($docente->dedicacion, 0, 1).substr(strstr($docente->dedicacion, ' '), 1, 1)}}</td>
                                <td>Otto</td>
                                <td>{{ $asistencia->entrada }}</td>
                                <td>{{ $asistencia->firmae }}</td>
                                <td>{{ $asistencia->salida }}</td>
                                <td>{{ $asistencia->firmas }}</td> --}}
                            </tr>
                        </tbody>
                        </table>
                        {{-- <h5>Docentes no registrados</h5> --}}
                    @endif
                @endforeach
                </div>
            @else
                <h3 id="titulo">Parte Diario de Asistencia</h3>
                {{-- Faculdad: {{ $dato->nomfac }} --}}
                <h5>No hyay deptos</h5>
            @endif
        @endforeach

    {{-- </div> --}}

    <div class="page_break">
        <h3>Esto ya sería una nueva página</h3>
        ...
    </div>



</body>

</html>
