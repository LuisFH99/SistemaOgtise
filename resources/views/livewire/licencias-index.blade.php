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
                            <table class="table table-striped" id="idtablelicencia">
                                <thead class="text-white bluenr">
                                    <tr class="text-center">
                                        <th scope="col">Código de licencia</th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Hora</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($solicitudes as $solicitud)
                                    <tr>
                                        <td>{{$solicitud->codigo}}</td>
                                        <td>{{$solicitud->fech_solicitud}}</td>
                                        <td>{{$solicitud->hor_solicitud}}</td>
                                        @switch($solicitud->estadoSol)
                                            @case('Enviada')
                                                <td><span class="badge badge-primary">{{$solicitud->estadoSol}}</span></td>
                                                @break
                                            @case('Procesada')
                                                <td><span class="badge badge-secondary">{{$solicitud->estadoSol}}</span></td>
                                                @break
                                            @case('Visto Bueno')
                                                <td><span class="badge badge-info">{{$solicitud->estadoSol}}</span></td>
                                                @break
                                            @case('Admitida')
                                                <td><span class="badge badge-light">{{$solicitud->estadoSol}}</span></td>
                                                @break
                                            @case('Aprobada')
                                                <td><span class="badge badge-success">{{$solicitud->estadoSol}}</span></td>
                                                @break
                                            @case('Denegada')
                                                <td><span class="badge badge-danger">{{$solicitud->estadoSol}}</span></td>
                                                @break
                                            @default
                                                <td><span>{{$solicitud->estadoSol}}</span></td>
                                        @endswitch
                                        <td width="100px">
                                            <a class="btn btn-primary btn-sm" href="#" onclick="imprimir({{$solicitud->idSolicitudes.',\''.$solicitud->fech_solicitud.'\',\''.$solicitud->hor_solicitud.'\''}})"><i class="far fa-eye mr-1"></i></a>
                                            <a class="btn btn-danger btn-sm" href="#" onclick="eliminar({{$solicitud->idSolicitudes}})"><i class="far fa-trash-alt" aria-hidden="true"></i></a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            {{$solicitudes->links()}}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
</div>
