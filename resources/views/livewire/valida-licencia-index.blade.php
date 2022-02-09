<div>
    <div class="row">
        <div class="col-14 p-2 anc">
            <div class="card fondo-cards">
                <div class="col-14 card-body ">
                    @if ($aux==0)
                        <h2>Licencias Solicitadas:</h2>
                    @else
                        <h2>Listado de Licencias:</h2>
                    @endif
                    <div class="row">
                        <div class="input-group rounded col-6">
                            <input wire:model="search" type="search" class="form-control rounded" placeholder="Buscar" aria-label="Search"
                            aria-describedby="search-addon" />
                            <span class="input-group-text border-0" id="search-addon">
                              <i class="fas fa-search"></i>
                            </span>
                        </div>
                        <div class="input-group rounded col-6">
                            <p class="col-2 d-flex align-items-center mr-1"><b>Estado: </b></p>
                            {!! Form::select('estado', $estados, null, ['placeholder' => 'Seleccione...',
                                                                        'class'=>'form-control col-3',
                                                                        'wire:model'=>'combo']) !!}
                            
                        </div>
                    </div>
                    @if ($licencias->count()==0)
                        <div class="card-body"> 
                            <center><strong>No hay Licencias a Mostrar</strong></center>
                        </div>
                    @else
                        <div class="table-responsive">
                            <table class="table table-striped" id="idtableSalidas">
                                <thead class="text-white bluenr">
                                    <tr class="text-center">
                                        <th scope="col">Código</th>
                                        <th scope="col">Docente</th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Motivo</th>
                                        <th scope="col">Dias Ausente</th>
                                        <th scope="col">Fecha de Retorno</th>
                                        <th scope="col">Estado</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($licencias as $licencia)
                                        <tr class="{{($estado==$licencia->estadoSol)?'font-weight-bold':'font-weight-normal';}}">
                                            <td>{{$licencia->codigo}}</td>
                                            <td>{{$licencia->apellPat.' '.$licencia->apellMat.' '.$licencia->nombres}}</td>
                                            <td>{{$licencia->fech_solicitud}}</td>
                                            <td>{{$licencia->motivo}}</td>
                                            <td>{{$licencia->num_dias}}</td>
                                            <td>{{$licencia->fech_retorno}}</td>
                                            @switch($licencia->estadoSol)
                                                @case('Enviada')
                                                    <td><span class="badge badge-primary">{{$licencia->estadoSol}}</span></td>
                                                    @break
                                                @case('Procesada')
                                                    <td><span class="badge badge-secondary">{{$licencia->estadoSol}}</span></td>
                                                    @break
                                                @case('Visto Bueno')
                                                    <td><span class="badge badge-info">{{$licencia->estadoSol}}</span></td>
                                                    @break
                                                @case('Admitida')
                                                    <td><span class="badge badge-light">{{$licencia->estadoSol}}</span></td>
                                                    @break
                                                @case('Aprobada')
                                                    <td><span class="badge badge-success">{{$licencia->estadoSol}}</span></td>
                                                    @break
                                                @case('Denegada')
                                                    <td><span class="badge badge-danger">{{$licencia->estadoSol}}</span></td>
                                                    @break
                                                @default
                                                    <td><span>{{$licencia->estadoSol}}</span></td>
                                            @endswitch
                                            <td width="50px">
                                                <a class="btn btn-primary btn-sm" href="#"
                                                onclick="selecId({{$licencia->idSolicitudes}},'{{$licencia->fech_solicitud}}','{{$licencia->hor_solicitud}}','{{$licencia->apellPat.' '.$licencia->apellMat.' '.$licencia->nombres}}','{{$estado}}','{{$licencia->estadoSol}}')"><i class="far fa-eye"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer">
                            {{$licencias->links()}}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
