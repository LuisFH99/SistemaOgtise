@extends('adminlte::page')

@section('title', 'Inicio')

@section('content_header')
    <h1>Usuarios</h1>
@stop

@section('content')
@if (session('info'))
    <div class="alert alert-success">
        <strong>{{session('info')}}</strong>
    </div>
@endif
@if (session('info1'))
    <div class="alert alert-danger">
        <strong>{{session('info1')}}</strong>
    </div>
@endif
    <div class="card">
        <div class="card-body">
            <div >
                <p class="h5"><b>Gestión de Usuarios:</b></p>
            </div>
            <div class="col-md-12">
                <div class="card-body">
                    {!! Form::open(['route' => ['Admin.users.store'],'method'=>'post']) !!}
                        <div class="row">
                            <div class="col-md-2 col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('DNI:', null, ['class' => 'control-label']) }}
                                    {{ Form::text('dni', null, array_merge(['class' => 'form-control'], ['placeholder'=>'Ingrese el N° DNI',
                                                                                                            'maxlength'=>'8',
                                                                                                            'onkeypress'=>'return SoloNumeros(event)',
                                                                                                            'tabindex'=>'1'])) }}
                                    @error('dni')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-2 col-sm-6">
                                <label class="form-label">Apellidos Paterno:</label>
                                <input type="text" id="apepat" name="apepat" class="form-control" placeholder="" tabindex="2">
                                @error('apepat')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                                {{-- <div class="form-group">
                                    {{ Form::label('Apellidos Paterno:', null, ['class' => 'control-label']) }}
                                    {{ Form::text('apepat', null, array_merge(['class' => 'form-control'], ['tabindex'=>'2'])) }}
                                </div> --}}
                            </div>
                            <div class="col-md-2 col-sm-6">
                                <label class="form-label">Apellidos Materno:</label>
                                <input type="text" id="apemat" name="apemat" class="form-control" placeholder="" tabindex="3">
                                @error('apemat')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                                {{-- <div class="form-group">
                                    {{ Form::label('Apellidos Materno:', null, ['class' => 'control-label']) }}
                                    {{ Form::text('apemat', null, array_merge(['class' => 'form-control'], ['tabindex'=>'3'])) }}
                                </div> --}}
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <label class="form-label">Nombres:</label>
                                <input type="text" id="nombres" name="nombres" class="form-control" placeholder="" tabindex="4">
                                @error('nombres')
                                    <small class="text-danger">{{$message}}</small>
                                @enderror
                                {{-- <div class="form-group">
                                    {{ Form::label('Nombres:', null, ['class' => 'control-label']) }}
                                    {{ Form::text('nombres', null, array_merge(['class' => 'form-control'], ['tabindex'=>'4'])) }}
                                </div> --}}
                            </div>
                            <div class="col-md-3 col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('Fecha de Nacimiento:', null, ['class' => 'control-label']) }}
                                    {{ Form::date('fnacimiento', null, array_merge(['class' => 'form-control'], ['tabindex'=>'5'])) }}
                                    @error('fnacimiento')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3 col-sm-6 my-3">
                                <div class="form-group">
                                    {{ Form::label('Celular:', null, ['class' => 'control-label']) }}
                                    {{ Form::text('numcel', null, array_merge(['class' => 'form-control'], ['placeholder'=>'Ingrese el N° Celular',
                                                                                                            'maxlength'=>'9',
                                                                                                            'onkeypress'=>'return SoloNumeros(event)',
                                                                                                            'tabindex'=>'6'])) }}
                                    @error('numcel')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                            </div>
                            </div>
                            <div class="col-md-3 col-sm-6 my-3">
                                <label class="form-label">Correo Institucional:</label>
                                <input type="email" id="email" name="email" class="form-control" placeholder="correo@unasam.edu.pe"
                                    tabindex="7">
                                    
                                {{-- <div class="form-group">
                                    {{ Form::label('Correo Institucional:', null, ['class' => 'control-label']) }}
                                    {{ Form::email('email', null, array_merge(['class' => 'form-control'], ['placeholder'=>'correo@unasam.edu.pe',
                                                                                                            'onfocus'=>'generaremail1()',
                                                                                                            'tabindex'=>'7'])) }} --}}
                                
                                    @error('email')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                {{-- </div> --}}
                            </div>
                            <div class="col-md-3 col-sm-6 my-3">
                                <div class="form-group">
                                    {{ Form::label('Cargo:', null, ['class' => 'control-label']) }}
                                    <div class="input-group">
                                        {!! Form::select('cargo', $cargos, null, ['placeholder' => 'Seleccione...','class'=>'form-control']) !!}
                                        {{-- <div class="input-group-append">
                                            <button id="addcargo" class="btn btn-primary" type="button"><span class="fa fa-plus"></span>
                                        </div> --}}
                                    </div>
                                    @error('cargo')
                                        <small class="text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                            </div>
                            <div class="d-flex align-items-center col-md-3 col-sm-6 my-3">
                                {{-- <button type="submit" class="d-flex btn btn-secondary mt-auto ml-auto" href="#">Crear Usuarios</button> --}}
                                {!! Form::submit('Crear Usuarios', ['class'=>'btn btn-secondary mt-auto ml-auto']) !!}
                            </div>
                        </div>
                    {!! Form::close() !!}    
                </div>
            </div>
            {{-- @if (session('info1'))
                <div class="alert alert-success">
                    <strong>{{session('info1')}}</strong>
                </div>
            @endif --}}
        </div>
    </div>
    @livewire('admin.users-index') 
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="/css/style.css">
    @livewireStyles 
@stop

@section('js')
    <script> let idp=0; console.log('Hi!'); 
    </script>
    
    <script>
        
        $(function() {
            $('#email').focus(function() {

                $(this).val("" + generaremail($('#nombres').val().trim(), $('#apepat').val().trim().replace(/ /g, ""), 
                    $('#apemat').val().trim()));
            });
        });

        function generaremail(nom, ap, am) {
            let dto = nom.charAt(0).replace('ñ', 'n') + ap.replace('ñ', 'n') + am.charAt(0).replace('ñ', 'n') + "@unasam.edu.pe";
            return dto.toLowerCase();
        }

        function selecNombre(nombre){
            document.getElementById('exampleModalLabel').innerHTML=""+nombre;
        }
        function generaremail1() {
            let nom=$.trim($('#nombres').val());
            let ap=$.trim($('#apepat'));
            let am=$.trim($('#apemat'));
            let dto = ""+nom.charAt(0) + ap + am.charAt(0) + "@unasam.edu.pe";
            $('#email').val(dto.toLowerCase());
        }
        function selectId(id){
            $.ajax({
                url: '/users/index/datos',
                method: 'POST',
                data: {
                    _token: $('input[name="_token"]').val(),
                    dt: id,
                }
            }).done(function(res) {
                alert(res.name);
                $('#idNombre').html(res.name);
                devolverNombres( res.id);
                $('#modalEdit').modal('show');
            }).fail(function(msg) {
                alert("error");
            });
            
            //event.preventDefault();
            //idp=id;
        }

        function devolverNombres( id){
            $.ajax({
                url: '/users/index/roles',
                method: 'POST',
                data: {
                    dt: id,
                }
            }).done(function(msg) {
                msg.id.forEach(element => {
                    // $("#selectall").on("click", function() {
                    //     $(".case").prop("checked", this.checked);
                    // });
                    alert (element);
                });
            }).fail(function(msg) {
                alert("error");
            });
        }
        
        function eliminar(id,email) {
            console.log(id+" - " +email);
            const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                    confirmButton: 'btn btn-danger mr-1',
                    cancelButton: 'btn btn-secondary mr-1'
                },
                buttonsStyling: false
            })

            swalWithBootstrapButtons.fire({
                title: 'Estas Seguro?',
                text: "Esta accion es Irreversible!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Eliminar!',
                cancelButtonText: 'Cancelar!',
                reverseButtons: false
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '/users/eliminar',
                        method: 'POST',
                        data: {
                            _token: $('input[name="_token"]').val(),
                            idu: id,
                            correo: email
                        }
                    }).done(function(msg) {
                        if (parseInt(msg) === 1) {
                            Swal.fire({
                                icon: 'info',
                                title: 'Usuario ELIMINADO ',
                                showConfirmButton: false,
                                timer: 4500
                            });
                            location.reload();
                        } else {
                            Swal.fire({
                                icon: 'warning',
                                title: 'No podemos eliminar al usuario',
                                showConfirmButton: false,
                                timer: 4500
                            });
                            location.reload();
                        }
                    }).fail(function(msg) {
                        console.log(msg);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Algo salio mal!...'
                        })
                    });

                }
            })
        }

        function listAllProperties(o) {
            var objectToInspect;
            var result = [];

            for(objectToInspect = o; objectToInspect !== null;
                objectToInspect = Object.getPrototypeOf(objectToInspect)) {
                result = result.concat(
                    Object.getOwnPropertyNames(objectToInspect)
                );
            }

                return result;
        }

        function SoloNumeros(e){
            var key= Window.Event? e.which : e.keyCode;
            if (key < 48 || key > 57) { 
                e.preventDefault();
            }
        };
    </script>
    @livewireScripts
@stop
