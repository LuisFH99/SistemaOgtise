<div>
    <div >
        <div class="row">
            <div class="col-md-10 mr-1">
                {{-- <p class="h5"><b>Gestión de Usuarios y Roles:</b></p> --}}
            </div>
            <div class="col-md-1">
                <input type="checkbox" checked data-toggle="toggle" data-on="Editar" data-off="Editando" data-onstyle="danger" data-offstyle="success" id="toggle-state">
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card-body">
            {{-- {!! Form::open(['route' => ['Admin.users.store'],'method'=>'post']) !!} --}}
            {!! Form::model($user,['route' => ['Admin.users.update',$user],'method'=>'put'])!!}
                <div class="row d-none" id="divEdit">
                    <div class="col-md-12">
                        <h5>Editar Usuario:</h5>
                    </div>
                    <div class="col-md-2 col-sm-6">
                        <div class="form-group">
                            {!! Form::hidden('idper', $Persona->idPersonas, ['class' => 'control-label']) !!}
                            {{ Form::label('DNI:', null, ['class' => 'control-label']) }}
                            {{ Form::text('dni', $Persona->DNI, array_merge(['class' => 'form-control'], ['placeholder'=>'Ingrese el N° DNI',
                                                                                                    'maxlength'=>'8',
                                                                                                    'onkeypress'=>'return SoloNumeros(event)',
                                                                                                    'tabindex'=>'1'])) }}
                            @error('dni')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-6">
                        {{-- <label class="form-label">Apellidos Paterno:</label>
                        <input type="text" id="apepat" name="apepat" class="form-control" placeholder="" tabindex="2"> --}}
                        <div class="form-group">
                            {{ Form::label('Apellidos Paterno:', null, ['class' => 'control-label']) }}
                            {{ Form::text('apepat', $Persona->apellPat, array_merge(['class' => 'form-control'], ['tabindex'=>'2'])) }}
                            @error('apepat')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        
                    </div>
                    <div class="col-md-2 col-sm-6">
                        {{-- <label class="form-label">Apellidos Materno:</label>
                        <input type="text" id="apemat" name="apemat" class="form-control" placeholder="" tabindex="3"> --}}
                        <div class="form-group">
                            {{ Form::label('Apellidos Materno:', null, ['class' => 'control-label']) }}
                            {{ Form::text('apemat',$Persona->apellMat, array_merge(['class' => 'form-control'], ['tabindex'=>'3'])) }}
                            @error('apemat')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        {{-- <label class="form-label">Nombres:</label>
                        <input type="text" id="nombres" name="nombres" class="form-control" placeholder="" tabindex="4"> --}}
                        <div class="form-group">
                            {{ Form::label('Nombres:', null, ['class' => 'control-label']) }}
                            {{ Form::text('nombres', $Persona->nombres, array_merge(['class' => 'form-control'], ['tabindex'=>'4'])) }}
                            @error('nombres')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6">
                        <div class="form-group">
                            {{ Form::label('Fecha de Nacimiento:', null, ['class' => 'control-label']) }}
                            {{ Form::date('fnacimiento', $Persona->fechNacimiento, array_merge(['class' => 'form-control'], ['tabindex'=>'5'])) }}
                            @error('fnacimiento')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 my-3">
                        <div class="form-group">
                            {{ Form::label('Celular:', null, ['class' => 'control-label']) }}
                            {{ Form::text('numcel', $Persona->telefono, array_merge(['class' => 'form-control'], ['placeholder'=>'Ingrese el N° Celular',
                                                                                                    'maxlength'=>'9',
                                                                                                    'onkeypress'=>'return SoloNumeros(event)',
                                                                                                    'tabindex'=>'6'])) }}
                            @error('numcel')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 my-3">
                        {{-- <label class="form-label">Correo Institucional:</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="correo@unasam.edu.pe"
                            tabindex="7"> --}}
                        <div class="form-group">
                            {{ Form::label('Correo Institucional:', null, ['class' => 'control-label']) }}
                            {{ Form::email('email', $Persona->correo, array_merge(['class' => 'form-control'], ['placeholder'=>'correo@unasam.edu.pe',
                                                                                                    'onfocus'=>'generaremail1()',
                                                                                                    'tabindex'=>'7'])) }}
                        
                            @error('email')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 my-3">
                        {{-- <div class="form-group">
                            {{ Form::label('Cargo:', null, ['class' => 'control-label']) }}
                            <div class="input-group">
                                {!! Form::select('cargo', $cargos, null, ['placeholder' => 'Seleccione...','class'=>'form-control']) !!}
                                <div class="input-group-append">
                                    <button id="addcargo" class="btn btn-primary" type="button"><span class="fa fa-plus"></span>
                                </div>
                            </div>
                            @error('cargo')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div> --}}
                    </div>
                    <div class="d-flex align-items-center col-md-3 col-sm-6 my-3">
                        {{-- <button type="submit" class="d-flex btn btn-secondary mt-auto ml-auto" href="#">Crear Usuarios</button> --}}
                        {{-- {!! Form::submit('Crear Usuarios', ['class'=>'d-flex btn btn-secondary mt-auto ml-auto']) !!} --}}
                    </div>
                </div>
                <div class="row">
                    <h5>Listado de Roles:</h5>
                    <div class="col-md-12 mr-1">
                        {!! Form::hidden('bdr', 0, ['class' => 'control-label']) !!}
                        @foreach ($roles as $role)
                                <label class="mr-4">
                                    {!! Form::checkbox('roles[]', $role->id, null, ['class'=>'mr-1 alicb']) !!}
                                    {{$role->name}}
                                </label>
                        @endforeach
                    </div>
                    <div class="col-md-12 mr-1">
                        {!! Form::submit('Editar', ['class'=>'btn btn-primary mt-2']) !!}  
                    </div>
                </div>              
                {{-- {!! Form::close() !!} --}}
            {!! Form::close() !!}    
        </div>
    </div>
</div>