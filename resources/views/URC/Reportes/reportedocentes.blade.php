<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
            /* height: 2cm; */
            text-align: center;
            /* border: 1px solid #000; */
        }

        #titulo {
            text-align: center;
            /* background-color: blue; */
            /* margin-top: 100px; */
        }

        #tableIden {
            width: 100%;
            border-collapse: collapse;
        }

        #tableIden th,
        #tableIden td {
            padding: 5px;
            text-align: center;
        }

        #tableIden th {

            font-size: 13px;
        }

        #tableIden td {
            font-size: 12px;
        }

        #table {
            border-collapse: collapse;
            width: 100%;
        }

        #table td,
        #table th {
            border: 1px solid #ddd;
            padding: 5px;
        }

        #table th {
            padding-top: 3px;
            padding-bottom: 3px;
            /* text-emphasis: left; */
            background-color: #003E78;
            color: #ffff;
            font-size: 13px;
        }

        #table td {
            font-size: 12px;
        }

    </style>
</head>

<body>
    <div class="header">
        <img src="Uploads/Frame.jpg" alt="">
    </div>
    <h3 id="titulo">Registro de Asistencia</h3>

    <table id="tableIden">
        <thead>
            <tr>
                <th>Docente:</th>
                <th>Facultad:</th>
                <th>Dpto. Academico:</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $docentes->nombres }}</td>
                <td>{{ $docentes->nomfac }}</td>
                <td>{{ $docentes->nomdep }}</td>
            </tr>
            <tr>
                <th>Condicion:</th>
                <th>Categoria:</th>
                <th>Dedicacion:</th>
            </tr>
            <tr>
                <td>{{ $docentes->nomcondi }}</td>
                <td>{{ $docentes->nomcat }}</td>
                <td>{{ $docentes->nomdedi }}</td>
            </tr>
        </tbody>
    </table>
    <br>
    <table id="table">
        <thead>
            <tr>
                <th rowspan="2">Dia</th>
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
            @foreach ($datos as $dato)
                @switch($dato->fk_idestadoAsistencias)
                    @case(1)
                        <tr>
                            <td>{{ $dato->Dia }}</td>
                            <td style="text-align: center"><img src=".{{ $dato->foto }}" width="55"></td>
                            <td style="text-align: center">{{ $dato->hor_entrada }}</td>
                            <td style="font-size: 6px">
                                <p style="display: inline"> Firmado por:{{ $docentes->nombres }} </p><br>
                                <p style="display: inline"> DNI:{{ $docentes->dni }} </p><br>
                                <p style="display: inline">Motivo: Registro asistencia</p><br>
                                <p style="display: inline">{{ $dato->fentrada }}</p><br>
                                <p style="display: inline">{{ $dato->tkentrada }}</p>

                            </td>
                            @if ($dato->hor_salida != '00:00:00')

                                <td style="text-align: center">{{ $dato->hor_salida }}</td>
                                <td style="font-size: 6px">
                                    <p style="display: inline"> Firmado por:{{ $docentes->nombres }} </p><br>
                                    <p style="display: inline"> DNI:{{ $docentes->dni }} </p><br>
                                    <p style="display: inline">Motivo: Registro asistencia</p><br>
                                    <p style="display: inline">{{ $dato->fsalida }}</p><br>
                                    <p style="display: inline">{{ $dato->tksalida }}</p>

                                </td>
                            @else
                                <td colspan="2">No hay registro</td>
                            @endif
                        </tr>
                    @break
                    @case(2)
                        <tr>
                            <td>{{ $dato->Dia }}</td>
                            <td colspan="5">No Registro Asistencia</td>
                        </tr>
                    @break
                    @case(3)
                        <tr>
                            <td>{{ $dato->Dia }}</td>
                            <td colspan="5">Falta Justificada</td>
                        </tr>
                    @break
                    @case(4)
                        <tr>
                            <td>{{ $dato->Dia }}</td>
                            <td colspan="5">Licencia Aprobada</td>
                        </tr>
                    @break
                    @case(5)
                        <tr>
                            <td>{{ $dato->Dia }}</td>
                            <td colspan="5">Dia No Laborable</td>
                        </tr>
                    @break

                @endswitch

            @endforeach

        </tbody>
    </table>


</body>

</html>
