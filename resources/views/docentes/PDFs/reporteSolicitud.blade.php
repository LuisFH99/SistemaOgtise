<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Solicitud</title>
    <style>
        .titulo{
            text-align: center;
        }
        .Row {
            display: table;
            width: 100%; /*Optional*/
            table-layout: fixed; /*Optional*/
            border-spacing: 10px; /*Optional*/
        }
        .Column {   
            display: table-cell;
            /*background-color: red; Optional*/
        }
        
    </style>
</head>
<body>
    <img src="Uploads/Membrete RRHH URYC_001.jpg" width="700">
    <div>
        <h1 class="titulo">Solicitud de Licencia </h1><br>
        <div>
            <p>YO: <b>{{$solicitudes->nombres.' '.$solicitudes->apellPat.' '.$solicitudes->apellMat}}</b> identificado con el DNI N° 
                <b>{{$solicitudes->DNI}}</b> perteneciente al <b>{{$solicitudes->nomdep}}</b>, <b>{{$solicitudes->nomFac}}</b>.</p>
            <p>Solicito licencia por el siguiente motivo:</p>
            <p style="text-align: center;"><b>{{$solicitudes->motivo}}</b></p>
            <p>Bajo la siguiente Justificación:</p>
            <p>-> {{$solicitudes->justificacion}}</p> 
            <p>Me ausentare desde el  <b>{{$solicitudes->fech_inicio}}</b>  hasta el  <b>{{$solicitudes->fech_fin}}</b> 
                 cuyo total en número de dias calendario es  <b> {{$solicitudes->num_dias}}</b>  y la fecha de reincorporación es 
                <b>{{$solicitudes->fech_retorno}}</b> </p><br>
            <div class="Row">
                <div class="Column"></div>
                <div class="Column">
                    <p style="display: inline">Firmado el dia <b>{{$solicitudes->fech_solicitud.' '.$solicitudes->hor_solicitud}}</b></p><br>
                    <p style="display: inline">via firma <b>{{$solicitudes->tipo}}</b></p><br>
                    <p style="display: inline">Razón: <b>{{$solicitudes->token}}</b></p><br>
                    <p style="display: inline">Ubicación: <b>{{$solicitudes->firma}}</b></p><br>
                    <p style="display: inline">Nombre: <b>{{$solicitudes->nombres.' '.$solicitudes->apellPat.' '.$solicitudes->apellMat}}</b></p><br> 
                    <p style="display: inline">DNI N° <b>{{$solicitudes->DNI}}</b></p>
                </div>
            </div>
            <p>Contiene <b>{{$DocsAd->count()}}</b> archivo(s) adjunto(s): </p>
                @if ($DocsAd->count()>0)
                    <table>
                        <thead>
                            <tr>
                                <th>Adjuntos:</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($DocsAd as $doc)    
                                {{$aux++;}}
                                <tr>
                                    <td></td>
                                    <td><a style="display: inline" href="{{$doc->docs}}">Archivo Adjunto {{$aux}}</a></td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            <p>La solicitud de la licencia se encuentra <b>{{$solicitudes->estadoSol}}</b></p>    
        </div>  
    </div>
</body>
</html>