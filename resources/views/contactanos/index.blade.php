<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="sweetalert2.all.min.js"></script>
</head>
<body>
    @if (session('info'))
        <script>
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: "{{session('info')}}",
                showConfirmButton: false,
                timer: 3500
            });
        </script>
    @endif
    <form action="{{route('contactanos.store')}}" method="post">
        @csrf
        <input type="text" name="name">
        <input type="email" name="correo" id="">
        <textarea name="mensaje" id="" cols="10" rows="3"></textarea>
        <button type="submit">Enviar</button>
    </form>
    
</body>
</html>