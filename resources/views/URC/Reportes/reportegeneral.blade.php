<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Parte Diario</title>
    <style>
        @page {
            margin: 0px 0px;
        }

        body {
            margin-top: 2.5cm;
            margin-left: 2cm;
            margin-right: 2cm;
            margin-bottom: 2cm;
        }

        .header {
            position: fixed;
            top: 0.2cm;
            left: 0cm;
            right: 0cm;
            text-align: center;
        }


        #titulo {
            text-align: center;
        }

        #tableIden {
            width: 100%;
        }

        #tableIden th,
        #tableIden td {
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

        #table th,
        #tableResumen th {
            padding-top: 3px;
            padding-bottom: 3px;
            background-color: #003E78;
            color: #ffff;
            font-size: 13px;
        }

        #table td,
        #tableResumen td {
            font-size: 12px;
        }

        #divresumen{
            margin-top: 10px; 
        }

        #tableResumen{
            border-collapse: collapse;
        }

        #tableResumen th,
        #tableResumen td {
            text-align: center;
            border: 1px solid #ddd;
            padding: 8px;
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
        $aux = '';
    @endphp
    @foreach ($datos as $dato)
        @if (json_decode($dato->departamentos) != null)
            @foreach (json_decode($dato->departamentos) as $departamento)

                <div class="{{ $aux }}">
                    <h3 id="titulo">Parte Diario de Asistencia</h3>
                    @php
                        $aux = 'page_break';
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
                                <td>{{ $fecha }}</td>
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
                                $cont = 1;
                                $cantpresente = 0;
                                $cantfalta = 0;
                                $cantjusti = 0;
                                $cantLicencia = 0;
                            @endphp
                            @if ($departamento->docentes != null)
                                @foreach ($departamento->docentes as $docente)
                                    @if ($docente->datoasistencias != null)
                                        @foreach ($docente->datoasistencias as $asistencia)
                                            @switch($asistencia->estado)
                                                @case(1)
                                                    {{ $cantpresente++ }}
                                                    <tr>
                                                        <td scope="row" style="text-align: center">{{ $cont++ }}</td>
                                                        <td>{{ $docente->nombres }}</td>
                                                        <td style="text-align: center">
                                                            {{ strtoupper(substr($docente->condicion, 0, 1) . '-' . substr($docente->categoria, $docente->categoria == 'Auxiliar' ? 2 : 0, 1)) . substr($docente->dedicacion, 0, 1) . substr(strstr($docente->dedicacion, ' '), 1, 1) }}
                                                        </td>
                                                        <td style="text-align: center"> <img
                                                                src=".{{ $asistencia->foto }}" width="55"> </td>
                                                        <td style="text-align: center">
                                                            {{ substr($asistencia->entrada, 0, 8) }}</td>
                                                        <td style="font-size: 6px">
                                                            <p style="display: inline"> Firmado
                                                                por:{{ $docente->nombres }} </p><br>
                                                            <p style="display: inline"> DNI:{{ $docente->dni }} </p><br>
                                                            <p style="display: inline">Motivo: Registro asistencia</p><br>
                                                            <p style="display: inline">{{ $asistencia->firmae }}</p><br>
                                                            <p style="display: inline">{{ $asistencia->tkentrada }}</p>
                                                        </td>

                                                        <td style="text-align: center">
                                                            {{ substr($asistencia->salida, 0, 8) }}</td>
                                                        <td style="font-size: 6px">
                                                            <p style="display: inline"> Firmado
                                                                por:{{ $docente->nombres }} </p>
                                                            <p style="display: inline"> DNI:{{ $docente->dni }} </p>
                                                            <br>
                                                            <p style="display: inline">Motivo: Registro asistencia</p>
                                                            <br>
                                                            <p style="display: inline">{{ $asistencia->firmas }}</p>
                                                            <br>
                                                            <p style="display: inline">{{ $asistencia->tksalida }}
                                                            </p>
                                                        </td>


                                                    </tr>
                                                @break
                                                @case(2)
                                                    {{ $cantfalta++ }}
                                                    <tr>
                                                        <td scope="row">{{ $cont++ }}</td>
                                                        <td>{{ $docente->nombres }}</td>
                                                        <td style="text-align: center">{{ strtoupper(substr($docente->condicion, 0, 1) . '-' . substr($docente->categoria, $docente->categoria == 'Auxiliar' ? 2 : 0, 1)) . substr($docente->dedicacion, 0, 1) . substr(strstr($docente->dedicacion, ' '), 1, 1) }}
                                                        </td>
                                                        <td colspan="5">No Registro su Asistencia</td>
                                                    </tr>
                                                @break
                                                @case(3)
                                                    {{ $cantjusti++ }}
                                                    <tr>
                                                        <td scope="row">{{ $cont++ }}</td>
                                                        <td>{{ $docente->nombres }}</td>
                                                        <td style="text-align: center">{{ strtoupper(substr($docente->condicion, 0, 1) . '-' . substr($docente->categoria, $docente->categoria == 'Auxiliar' ? 2 : 0, 1)) . substr($docente->dedicacion, 0, 1) . substr(strstr($docente->dedicacion, ' '), 1, 1) }}
                                                        </td>
                                                        <td colspan="5">Inasistencia Justificada</td>
                                                    </tr>
                                                @break
                                                @case(4)
                                                    {{$cantLicencia++}}
                                                    <tr>
                                                        <td scope="row">{{ $cont++ }}</td>
                                                        <td>{{ $docente->nombres }}</td>
                                                        <td style="text-align: center">{{ strtoupper(substr($docente->condicion, 0, 1) . '-' . substr($docente->categoria, $docente->categoria == 'Auxiliar' ? 2 : 0, 1)) . substr($docente->dedicacion, 0, 1) . substr(strstr($docente->dedicacion, ' '), 1, 1) }}
                                                        </td>
                                                        <td colspan="5">Licencia Aprobada</td>
                                                    </tr>
                                                @break
                                                @case(5)
                                                    <tr>
                                                        <td scope="row">{{ $cont++ }}</td>
                                                        <td>{{ $docente->nombres }}</td>
                                                        <td style="text-align: center">{{ strtoupper(substr($docente->condicion, 0, 1) . '-' . substr($docente->categoria, $docente->categoria == 'Auxiliar' ? 2 : 0, 1)) . substr($docente->dedicacion, 0, 1) . substr(strstr($docente->dedicacion, ' '), 1, 1) }}
                                                        </td>
                                                        <td colspan="5">Dia Laborable</td>
                                                    </tr>
                                                @break
                                                @case(6)
                                                    {{ $cantpresente++ }}
                                                    <tr>
                                                        <td scope="row" style="text-align: center">{{ $cont++ }}</td>
                                                        <td>{{ $docente->nombres }}</td>
                                                        <td style="text-align: ce nter">
                                                            {{ strtoupper(substr($docente->condicion, 0, 1) . '-' . substr($docente->categoria, $docente->categoria == 'Auxiliar' ? 2 : 0, 1)) . substr($docente->dedicacion, 0, 1) . substr(strstr($docente->dedicacion, ' '), 1, 1) }}
                                                        </td>
                                                        <td style="text-align: center"> <img
                                                                src=".{{ $asistencia->foto }}" width="55"> </td>
                                                        <td style="text-align: center">
                                                            {{ substr($asistencia->entrada, 0, 8) }}</td>
                                                        <td style="font-size: 6px">
                                                            <p style="display: inline"> Firmado
                                                                por:{{ $docente->nombres }} </p><br>
                                                            <p style="display: inline"> DNI:{{ $docente->dni }} </p><br>
                                                            <p style="display: inline">Motivo: Registro asistencia</p><br>
                                                            <p style="display: inline">{{ $asistencia->firmae }}</p><br>
                                                            <p style="display: inline">{{ $asistencia->tkentrada }}</p>
                                                        </td>
                                                        <td colspan="2">No hay registro</td>
                                                    </tr>
                                                @break
                                                @default

                                            @endswitch

                                        @endforeach

                                    @else
                                        <tr>
                                            <td scope="row">{{ $cont++ }}</td>
                                            <td>{{ $docente->nombres }}</td>
                                            <td style="text-align: center">{{ strtoupper(substr($docente->condicion, 0, 1) . '-' . substr($docente->categoria, $docente->categoria == 'Auxiliar' ? 2 : 0, 1)) . substr($docente->dedicacion, 0, 1) . substr(strstr($docente->dedicacion, ' '), 1, 1) }}
                                            </td>
                                            <td colspan="5">Puede que tenga un Cargo o no Trabaje ese dia</td>

                                        </tr>
                                    @endif

                                @endforeach
                        </tbody>
                    </table>
                    <div id="divresumen">
                        <table id="tableResumen">
                            <thead>
                                <tr>
                                    <th colspan="4">Resumen Parte Diario</th>
                                </tr>
                                <tr>
                                    <th>Cant. Presentes</th>
                                    <th>Cant. Ausentes</th>
                                    <th>Justificados</th>
                                    <th>De Licencia</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $cantpresente }}</td>
                                    <td>{{ $cantfalta }}</td>
                                    <td>{{ $cantjusti }}</td>
                                    <td>{{ $cantLicencia }}</td>
                                </tr>
                            </tbody>
                        </table>  
                    </div>
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
