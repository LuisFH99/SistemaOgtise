<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        p {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
    </style>
</head>
<body>
    <h3>Credenciales de Acceso al Sistema de Gestion de Asistencia Docente</h3>
    <p>Estimado(a) {{$credenciales["docente"]}} perteneciente a la UNIVERSIDAD NACIONAL SANTIAGO ANTUNEZ DE MAYOLO, mediante la presente se le hace entrega de sus credenciales para el Acceso al Sistema de Gestión de Asistencia Docente:</p>
    <p><strong>Usuario: </strong>{{$credenciales["user"]}}</p>
    <p><strong>Contraseña: </strong>{{$credenciales["contra"]}}</p>
    <p><strong>Clave: </strong>{{$credenciales["clave"]}}</p>
    <p><strong>Link:</strong> <a href="https://registroycontrol.unasam.edu.pe/">https://registroycontrol.unasam.edu.pe/</a> </p>
    <p>La credencial Clave, servirá para realizar su registro de asistencia en el sistema y otras validaciones.</p>
</body>
</html>