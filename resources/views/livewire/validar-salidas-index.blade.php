<div>
    <div class="row">
        <div class="col-14 p-2 anc">
            <div class="card fondo-cards">
                <div class="col-14 card-body ">
                    <h2>Salidas Registradas:</h2>
                    <div class="row">
                        <div class="input-group rounded col-6">
                            <input wire:model="search" type="search" class="form-control rounded" placeholder="Buscar" aria-label="Search"
                            aria-describedby="search-addon" />
                            <span class="input-group-text border-0" id="search-addon">
                              <i class="fas fa-search"></i>
                            </span>
                        </div>
                        <div class="input-group rounded col-3" inline="true">
                            <label for="buscaFecha">Fecha: </label>
                            <input wire:model="sdate" type="date" id="buscaFecha" 
                                   min="2021-12-01" max="2050-12-31" class="form-control rounded fech">
                        </div>
                    
                    </div>
                    @if ($Salidas->count())
                        <div class="table-responsive">
                            <table class="table table-sm" id="idtableSalidas">
                                <thead class="text-white bluenr">
                                    <tr class="text-center">
                                        <th scope="col">Docente</th>
                                        <th scope="col">Tipo</th>
                                        <th scope="col">Hora de Salida</th>
                                        <th scope="col">Observación</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($Salidas as $Salida)
                                        <tr>
                                            <td>{{$Salida->apellPat.' '.$Salida->apellMat.' '.$Salida->nombres}}</td>
                                            <td>{{strtoupper(substr($Salida->nomCat, ($Salida->nomCat=='Auxiliar')?2:0,1)).substr($Salida->nomDedi, 0, 1).substr(strstr($Salida->nomDedi, ' '), 1, 1)}}</td>
                                            <td>{{$Salida->fecha.','.$Salida->hor_salida}}</td>
                                            <td>{{$Salida->observacion}}</td> 
                                            <td width="50px">
                                                <a class="btn btn-primary btn-sm" href="#"
                                                onclick="selecId({{$Salida->idAsistenciaSalidas}},'{{$Salida->nombres.' '.$Salida->apellPat.' '.$Salida->apellMat}}','{{$Salida->fecha}}','{{$Salida->hor_salida}}','{{$Salida->hor_entrada}}','{{$Salida->informe}}','{{$Salida->puntero}}')"><i class="far fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="card-body">
                            <strong>No hay Salidas a Validar</strong>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
