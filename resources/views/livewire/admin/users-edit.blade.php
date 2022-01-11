<div>
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
                                <div class="input-group-append">
                                    <button id="addcargo" class="btn btn-primary" type="button"><span class="fa fa-plus"></span>
                                </div>
                            </div>
                            @error('cargo')
                                <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="d-flex align-items-center col-md-3 col-sm-6 my-3">
                        {{-- <button type="submit" class="d-flex btn btn-secondary mt-auto ml-auto" href="#">Crear Usuarios</button> --}}
                        {!! Form::submit('Crear Usuarios', ['class'=>'d-flex btn btn-secondary mt-auto ml-auto']) !!}
                    </div>
                </div>
                {{-- <h5>Listado de Roles:</h5>
                {!! Form::model($user,['route' => ['Admin.users.update',$user],'method'=>'put']) !!}
                    @foreach ($roles as $role)
                        <div>
                            <label>
                                {!! Form::checkbox('roles[]', $role->id, null, ['class'=>'mr-1']) !!}
                                {{$role->name}}
                            </label>
                        </div>
                    @endforeach
                    {!! Form::submit('Asignar Rol', ['class'=>'btn btn-primary mt-2']) !!}                
                {!! Form::close() !!} --}}
            {!! Form::close() !!}    
        </div>
    </div>
</div>