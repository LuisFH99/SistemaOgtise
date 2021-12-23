@extends('adminlte::page')

@section('title', 'Academico | Docentes')

@section('plugins.Datatables', true)

@section('content_header')
    <h1 class="text-center">Lista de Docentes Registrados</h1>
@stop

@section('content')
    <div class="container">
        {{-- <div class="row">
            <a href="{{ route('creardocente') }}" class="btn btn-primary my-2">Registar Docente</a>
            <table id="tableDocentes" class="table table-sm shadow-lg">
                <thead class="text-white">
                    <tr>
                        <th scope="col">N°</th>
                        <th scope="col">Apellidos y Nombres</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Celular</th>
                        <th scope="col">Facultad</th>
                        <th scope="col">Depatameto Académico</th>
                        <th scope="col">Condición</th>
                        <th scope="col">Categoria</th>
                        <th scope="col">Dedicación</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>01</td>
                        <td>Miriam Lucero Gonzales de la Puerta</td>
                        <td>mlucerop@unasam.edu.pe</td>
                        <td>987456321</td>
                        <td>Ciencias</td>
                        <td>Ingenieria de Sistemas y Telecomunicaciones</td>
                        <td>Nombrado</td>
                        <td>Principal</td>
                        <td>Dedicacion Exclusiva</td>
                        <td>
                            <div class="centrado">
                                <span><i class="fas fa-eye mr-2"></i></span>
                                <span><i class="far fa-trash-alt"></i></span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>02</td>
                        <td>Cesar Manuel Gregorio Davila Paredes</td>
                        <td>cdavilap@unasam.edu.pe</td>
                        <td>987456321</td>
                        <td>Ciencias</td>
                        <td>Matematica</td>
                        <td>Contradado</td>
                        <td>Auxiliar</td>
                        <td>Tiempo Completo</td>
                        <td>
                            <div class="centrado">
                                <span><i class="fas fa-eye mr-2"></i></span>
                                <span><i class="far fa-trash-alt"></i></span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>03</td>
                        <td>Kiko Feliz Depaz Celi</td>
                        <td>kdepazc@unasam.edu.pe</td>
                        <td>987456321</td>
                        <td>Ingenieria Civil</td>
                        <td>Arquitectura</td>
                        <td>Contratado</td>
                        <td>Auxiliar</td>
                        <td>Tiempo Parcial</td>
                        <td>
                            <div class="centrado">
                                <span><i class="fas fa-eye mr-2"></i></span>
                                <span><i class="far fa-trash-alt"></i></span>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>

        </div> --}}
        @livewire('listar-docentes')
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/style.css">
@stop

@section('js')
@livewireScripts
    <script>
        $(document).ready(function() {
            // $('.nav-link').click();
            $('#tableDocentes').DataTable();
        });

        function saludo(dto){
            alert('hola'+dto);
        }
    </script>
@stop
