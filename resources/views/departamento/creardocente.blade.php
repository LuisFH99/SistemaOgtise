@extends('adminlte::page')

@section('title', 'Academico | Docentes')

@section('content_header')
    <h1 class="text-center">Gestión de Docentes</h1>
@stop

@section('content')

    <div class="container">
        <div class="card">
            <div class="card-header">
                <h4 class="">Crear Docentes</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('docentes.store') }}" method="POST">
                    <div class="col-12">
                        @csrf
                        @livewire('crear-docentes')
                      
                    </div>
                </form>
            </div>
        </div>
    </div>
    {{-- @livewire('crear-docentes'); --}}

@stop

@section('css')
    <link rel="stylesheet" href="/css/style.css">
@stop

@section('js')
    @livewireScripts
    @if (session('info'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: "{{ session('info') }}",

            })
        </script>
    @endif

    <script>
        $(document).ready(function() {
            // $('.nav-link').click();
            $('#email').focus(function() {
                $(this).val("" + generaremail($('#nombres').val().trim(), $('#apepat').val().trim(), $(
                    '#apemat').val().trim()));
            });
            // Swal.fire({
            //     icon: 'error',
            //     title: 'Oops...',
            //     text: 'Something went wrong!',

            // })

        });

        function generaremail(nom, ap, am) {
            let dto = nom.charAt(0) + ap + am.charAt(0) + "@unasam.edu.pe";
            return dto.toLowerCase();
        }

        function SoloNumeros(e) {
            var key = Window.Event ? e.which : e.keyCode;
            if (key < 48 || key > 57) {

                e.preventDefault();
            }
        }
    </script>
@stop
