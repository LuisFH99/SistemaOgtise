<div>
    <div class="row">
        <div class="col-14 p-2 anc">
            <div class="card fondo-cards">
                <div class="col-14 card-body ">
                    <h2>Licencias Solicitadas:</h2>
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
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Motivo</th>
                                    <th scope="col">Dias Ausente</th>
                                    <th scope="col">Fecha de Retorno</th>
                                    <th scope="col">Ver</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($licencias as $licencia)
                                    <tr>
                                        <td>{{$licencia->apellPat.' '.$licencia->apellMat.' '.$licencia->nombres}}</td>
                                        <td>{{$licencia->fech_solicitud}}</td>
                                        <td>{{$licencia->motivo}}</td>
                                        <td>{{$licencia->num_dias}}</td>
                                        <td>{{$licencia->fech_retorno}}</td>
                                        <td><a href="#"
                                            onclick="selecId({{$licencia->idSolicitudes}},'{{$licencia->url_doc}}','{{$licencia->fech_solicitud}}','{{$licencia->hor_solicitud}}','{{$licencia->apellPat.' '.$licencia->apellMat.' '.$licencia->nombres}}')"><i class="far fa-eye"></i></a></td>
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
