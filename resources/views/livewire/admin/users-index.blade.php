<div>
    <div class="card">
        <div class="card-body">
            <div>
                <p class="h5 mr-1"> <b> Lista de Usuarios:</b></p>
            </div>
        </div>
        <div class="card-body">
            <div class="input-group rounded col-6">
                <input wire:model="search" type="search" class="form-control rounded" placeholder="Buscar" aria-label="Search"
                    aria-describedby="search-addon" />
                <span class="input-group-text border-0" id="search-addon">
                    <i class="fas fa-search"></i>
                </span>
            </div>
        </div>
        @if($users->count())
            <div class="card-body  mt-n4">
                <table class="table table-striped" id="idtableUser">
                    <thead class="text-white bluenr">
                        <tr class="text-center">
                            <th>N°</th>
                            <th>DNI</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Clave</th>
                            <th>Tipo</th>
                            <th>Estado</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $aux=1;
                        @endphp
                        @foreach($users as $user)
                            <tr>
                                <td>{{$aux++}}</td>
                                <td>{{$user->DNI}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$user->clave}}</td>
                                <td>{{$user->tipo}}</td>
                                <td><span class="badge {{($user->activos ==1 )?'bg-success':'bg-danger'}}">{{($user->activos ==1 )?'Habilitado':'Deshabilitado'}}</span></td>
                                <td width="170px">
                                    <a class="btn btn-warning btn-sm" href="#" onclick="habilitar({{$user->id}},{{$user->activos}})" title="{{($user->activos ==1 )?'Deshabilitar':'Habilitar'}} Usuario"><i class="fas fa-arrow-alt-circle-{{($user->activos ==1 )?'down':'up'}} whiterr"></i></a>
                                    <a class="btn btn-primary btn-sm" href="{{route('Admin.users.edit',$user)}}" title="Editar Usuario"><i class="fas fa-user-edit"></i></a>
                                    <a class="btn btn-danger btn-sm" href="#" onclick="eliminar({{$user->id}},'{{$user->email}}')" title="Eliminar Usuario"><i class="far fa-trash-alt" aria-hidden="true"></i></a>
                                    <a class="btn btn-success btn-sm" href="#" onclick="restaurar({{$user->id}})" title="Reestablecer Contraseña"><i class="fas fa-key"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                {{$users->links()}}
            </div>
        @else
            <div class="card-body">
                <strong>No hay Registros</strong>
            </div>
        @endif
    </div>
</div>
