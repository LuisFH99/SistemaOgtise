
    <div class="row col-md-6">
        <div class="col-md-6 my-3">
            <label class="form-label">Facultad:</label>
    
            <select wire:model="selectFacultad" id="facultad" name="facultad" class="form-control" tabindex="8">
                <option selected="selected" value="">Seleccione...</option>
                @foreach ($facultades as $facultad)
                    <option value="{{ $facultad->id_Facultades }}">{{ $facultad->nomFac }}</option>
                @endforeach
            </select>
    
        </div>
    
        <div class="col-md-6 my-3">
            <label for="" class="form-label">Departamento Academico:</label>
    
            <select class="form-control" id="dptoacademico" name="dptoacademico" tabindex="9">
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
    </div>
