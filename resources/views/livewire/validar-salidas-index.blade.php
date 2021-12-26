<div>
    <div class="row">
        <div class="col-14 p-2 anc">
            <div class="card fondo-cards">
                <div class="col-14 card-body ">
                    <h2>Salidas Registradas:</h2>
                    <div class="input-group rounded col-6">
                        <input wire:model="search" type="search" class="form-control rounded" placeholder="Buscar" aria-label="Search"
                        aria-describedby="search-addon" />
                        <span class="input-group-text border-0" id="search-addon">
                          <i class="fas fa-search"></i>
                        </span>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-sm" id="idtableSalidas">
                            <thead>
                                <tr>
                                    <th scope="col">Docente</th>
                                    <th scope="col">Tipo</th>
                                    <th scope="col">Hora de Salida</th>
                                    <th scope="col">Observación</th>
                                    <th scope="col">Ver</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($Salidas as $Salida)
                                    <tr>
                                        <td>{{$Salida->apellPat.' '.$Salida->apellMat.' '.$Salida->nombres}}</td>
                                        <td>{{strtoupper(substr($Salida->nomCat, ($Salida->nomCat=='Auxiliar')?2:0,1)).substr($Salida->nomDedi, 0, 1).substr(strstr($Salida->nomDedi, ' '), 1, 1)}}</td>
                                        <td>{{$Salida->fecha.','.$Salida->hor_salida}}</td>
                                        <td>{{$Salida->observacion}}</td>
                                        <td><a href="#"
                                            onclick="selecId({{$Salida->idAsistenciaSalidas}})"><i class="far fa-eye"></i></a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
