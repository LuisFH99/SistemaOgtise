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
                        {{-- <div class="row"> --}}
                        {{-- <div class="col-md-2 col-sm-6">
                                <label class="form-label">DNI:</label>
                                <input type="text" class="form-control" id="dni" name="dni"
                                    placeholder="Ingrese el N° DNI" tabindex="1">
                            </div>
                            <div class="col-md-2 col-sm-6">
                                <label class="form-label">Apellidos Paterno:</label>
                                <input type="text" id="apepat" name="apepat" class="form-control" placeholder=""
                                    tabindex="2">
                            </div>
                            <div class="col-md-2 col-sm-6">
                                <label class="form-label">Apellidos Materno:</label>
                                <input type="text" id="apemat" name="apemat" class="form-control" placeholder=""
                                    tabindex="3">
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <label class="form-label">Nombres:</label>
                                <input type="text" id="nombres" name="nombres" class="form-control" placeholder=""
                                    tabindex="4">
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <label class="form-label">Fecha de Nacimiento</label>
                                <input type="date" id="fnacimiento" name="fnacimiento" class="form-control" tabindex="5">
                            </div>
                            <div class="col-md-3 col-sm-6 my-3">
                                <label class="form-label">Celular:</label>
                                <input type="text" id="numcel" name="numcel" class="form-control"
                                    placeholder="Ingrese N° celular" tabindex="6">
                            </div>
                            <div class="col-md-3 col-sm-6 my-3">
                                <label class="form-label">Correo Institucional:</label>
                                <input type="email" id="email" name="email" class="form-control"
                                    placeholder="correo@unasam.edu.pe" tabindex="7">
                            </div> --}}
                        {{-- <div class="col-md-3 col-sm-6 my-3">
                                <label for="" class="form-label">Facultad:</label>
                                <div class="input-group">
                                    <select class="form-control" id="facultad" name="facultad" tabindex="8">
                                        <option>Default select</option>
                                    </select>
                                    <div class="input-group-append">
                                        <button id="addfacultad" class="btn btn-primary" type="button"><span
                                                class="fa fa-plus"></span>
                                    </div>
                                </div>
                            </div> --}}
                        {{-- <div class="col-md-3 col-sm-6 my-3">
                                <label for="" class="form-label">Departamento Academico:</label>
                                <div class="input-group">
                                    <select class="form-control" id="dptoacademico" name="dptoacademico" tabindex="9">
                                        <option>Default select</option>
                                    </select>
                                    <div class="input-group-append">
                                        <button id="addfacultad" class="btn btn-primary" type="button"><span
                                                class="fa fa-plus-circle"></span>
                                    </div>
                                </div>
                            </div> --}}
                        {{-- <div class="col-md-4 col-sm-6 mb-3">
                                <label for="" class="form-label">Condición:</label>
                                <div class="input-group">
                                    <select class="form-control" id="condicion" name="condicion" tabindex="10">
                                        <option>Default select</option>
                                    </select>
                                    <div class="input-group-append">
                                        <button id="addcondicion" class="btn btn-primary" type="button"><span
                                                class="fa fa-plus"></span>
                                    </div>
                                </div>
                            </div> --}}
                        {{-- <div class="col-md-4 col-sm-6 mb-3">
                                <label for="" class="form-label">Categoría:</label>
                                <div class="input-group">
                                    <select class="form-control" id="categoria" name="categoria" tabindex="11">
                                        <option>Default select</option>
                                    </select>
                                    <div class="input-group-append">
                                        <button id="addcategoria" class="btn btn-primary" type="button"><span
                                                class="fa fa-plus-circle"></span>
                                    </div>
                                </div>
                            </div> --}}

                        {{-- <div class="col-md-4 col-sm-6 mb-3">
                                <label for="" class="form-label">Dedicación:</label>
                                <div class="input-group">
                                    <select class="form-control" id="dedicacion" name="dedicacion" tabindex="12">
                                        <option>Default select</option>
                                    </select>
                                    <div class="input-group-append">
                                        <button id="adddedicacion" class="btn btn-primary" type="button"><span
                                                class="fa fa-plus"></span>
                                    </div>
                                </div>
                            </div> --}}

                        {{-- <div class="col-12 mx-auto">
                                <div class="text-center">
                                    <a href="{{ route('docentes') }}" class="btn btn-secondary mr-2">Cancelar</a>
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </div> --}}
                        {{-- </div> --}}
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
