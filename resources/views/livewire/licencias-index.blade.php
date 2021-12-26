<div>
    <div class="row">
        <div class="col-14 p-2 anc">
            <div class="card fondo-cards">
                <div class="col-14 card-body ">
                    <h2>Mis Licencias:</h2>
                    <div class="input-group rounded col-6">
                        <input wire:model="search" type="search" class="form-control rounded" placeholder="Buscar" aria-label="Search"
                        aria-describedby="search-addon" />
                        <span class="input-group-text border-0" id="search-addon">
                          <i class="fas fa-search"></i>
                        </span>
                    </div>
                    @if ($aux==0||$solicitudes->count()==0)
                        <div class="card-body">
                            <center><strong>No hay Licencias a Mostrar</strong></center>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-sm " id="idtablelicencia">
                                <thead>
                                    <tr>
                                        <th scope="col">Código de licencia</th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Hora</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col">Ver</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($solicitudes as $solicitud)
                                    <tr>
                                        <td>{{$solicitud->codigo}}</td>
                                        <td>{{$solicitud->fech_solicitud}}</td>
                                        <td>{{$solicitud->hor_solicitud}}</td>
                                        <td>{{$solicitud->estadoSol}}</td>
                                        <td><a href="#" onclick="selectId({{$solicitud->idSolicitudes}})"><i class="far fa-eye"></i></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
</div>
