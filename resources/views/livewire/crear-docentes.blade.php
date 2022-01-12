{{-- {{ $facultades }}
    {{ $condiciones }}
    {{ $categorias }}
    {{ $dedicaciones }} wire:model --}}
<div class="row">
    <div class="col-md-2 col-sm-6">
        <label class="form-label">DNI:</label>
        <input type="text" class="form-control" id="dni" name="dni" placeholder="Ingrese el N° DNI" tabindex="1"
            maxlength="8" onkeypress="return SoloNumeros(event)" autocomplete="off">
        @error('dni')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="col-md-2 col-sm-6">
        <label class="form-label">Apellidos Paterno:</label>
        <input type="text" id="apepat" name="apepat" class="form-control" placeholder="" tabindex="2" autocomplete="off">
        @error('apepat')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="col-md-2 col-sm-6">
        <label class="form-label">Apellidos Materno:</label>
        <input type="text" id="apemat" name="apemat" class="form-control" placeholder="" tabindex="3" autocomplete="off">
        @error('apemat')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="col-md-3 col-sm-6">
        <label class="form-label">Nombres:</label>
        <input type="text" id="nombres" name="nombres" class="form-control" placeholder="" tabindex="4" autocomplete="off">
        @error('nombres')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="col-md-3 col-sm-6">
        <label class="form-label">Fecha de Nacimiento</label>
        <input type="date" id="fnacimiento" name="fnacimiento" class="form-control" tabindex="5">
        @error('fnacimiento')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="col-md-3 col-sm-6 my-3">
        <label class="form-label">Celular:</label>
        <input type="text" id="numcel" name="numcel" class="form-control" placeholder="Ingrese N° celular"
            tabindex="6" autocomplete="off">
        @error('numcel')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="col-md-3 col-sm-6 my-3">
        <label class="form-label">Correo Institucional:</label>
        <input type="email" id="email" name="email" class="form-control" placeholder="correo@unasam.edu.pe"
            tabindex="7" autocomplete="off">
        @error('email')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>
    <div class="col-md-3 col-sm-6 my-3">
        <label class="form-label">Facultad:</label>
        <div class="input-group">
            <select wire:model="selectFacultad" id="facultad" name="facultad" class="form-control" tabindex="8">
                <option>Seleccione...</option>
                @foreach ($facultades as $facultad)
                    <option value="{{ $facultad->id_Facultades }}">{{ $facultad->nomFac }}</option>
                @endforeach
            </select>
           
            {{-- <div class="input-group-append">
                <button id="addfacultad" class="btn btn-primary" type="button"><span class="fa fa-plus"></span>
            </div> --}}
        </div>
    </div>


    <div class="col-md-3 col-sm-6 my-3">
        <label for="" class="form-label">Departamento Academico:</label>
        <div class="input-group">
            <select class="form-control" id="dptoacademico" name="dptoacademico" tabindex="9">
                <option selected>Seleccione...</option>
                @if (!is_null($depacademicos))
                    @foreach ($depacademicos as $depacademico)
                        <option value="{{ $depacademico->idDepAcademicos }}">{{ $depacademico->nomdep }}</option>
                    @endforeach
                @endif
            </select>
            @error('dptoacademico')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            {{-- <div class="input-group-append">
                <button id="addfacultad" class="btn btn-primary" type="button"><span class="fa fa-plus-circle"></span>
            </div> --}}
        </div>
    </div>


    <div class="col-md-4 col-sm-6 mb-3">
        <label for="" class="form-label">Condición:</label>
        <div class="input-group">
            <select class="form-control" id="condicion" name="condicion" tabindex="10">
                <option>Seleccione...</option>
                @foreach ($condiciones as $condicion)
                    <option value="{{ $condicion->idCondiciones }}">{{ $condicion->nomCondi }}</option>
                @endforeach
            </select>
            @error('condicion')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            {{-- <div class="input-group-append">
                <button id="addcondicion" class="btn btn-primary" type="button"><span class="fa fa-plus"></span>
            </div> --}}
        </div>
    </div>

    <div class="col-md-4 col-sm-6 mb-3">
        <label for="" class="form-label">Categoría:</label>
        <div class="input-group">
            <select class="form-control" id="categoria" name="categoria" tabindex="11">
                <option>Seleccione...</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->idCategorias }}">{{ $categoria->nomCat }}</option>
                @endforeach
            </select>
            @error('categoria')
                <small class="text-danger">{{ $message }}</small>
            @enderror
            {{-- <div class="input-group-append">
                <button id="addcategoria" class="btn btn-primary" type="button"><span class="fa fa-plus-circle"></span>
            </div> --}}
        </div>
    </div>

    <div class="col-md-4 col-sm-6 mb-3">
        <label for="" class="form-label">Dedicación:</label>
        <div class="input-group">
            <select class="form-control" id="dedicacion" name="dedicacion" tabindex="12">
                <option>Seleccione...</option>
                @foreach ($dedicaciones as $dedicacion)
                    <option value="{{ $dedicacion->idDedicaciones }}">{{ $dedicacion->nomDedi }}</option>
                @endforeach
            </select>

        </div>
        @error('dedicacion')
            <small class="text-danger">{{ $message }}</small>
        @enderror

    </div>
    <div class="col-12 mx-auto">
        <div class="text-center">
            <a href="{{ route('docentes') }}" class="btn btn-secondary mr-2">Cancelar</a>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </div>
</div>
