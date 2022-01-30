<div class="row">
    <div class="col-md-3 col-sm-6">
        <label class="form-label">Facultad:</label>

        <select wire:model="selectFacultad" id="facultad" name="facultad" class="form-control" tabindex="4">
            <option selected="selected" value="">Seleccione...</option>
            @foreach ($facultades as $facultad)
                <option value="{{ $facultad->id_Facultades }}">{{ $facultad->nomFac }}</option>
            @endforeach
        </select>

    </div>


    <div class="col-md-3 col-sm-6">
        <label for="" class="form-label">Departamento Academico:</label>

        <select class="form-control" id="dptoacademico" name="dptoacademico" tabindex="5">
            <option selected="selected" value="">Seleccione...</option>
            @if (!is_null($depacademicos))
                @foreach ($depacademicos as $depacademico)
                    <option value="{{ $depacademico->idDepAcademicos }}">{{ $depacademico->nomdep }}</option>
                @endforeach
            @endif
        </select>
        @error('dptoacademico')
            <small class="text-danger">{{ $message }}</small>
        @enderror

    </div>

    <div class="col-md-3">
        <label class="form-label">Fecha de Reporte (*)</label>
        <input type="date" id="freporte1" name="freporte1" class="form-control" tabindex="6">
    </div>

    <div class="col-md-3 mt-4 d-flex align-items-center justify-content-center">
        <button type="button" class="btn btn-outline-primary mr-2" id="InformeDpto">Generar Informe</button>
        
    </div>


</div>
