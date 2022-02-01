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
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>DNI</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th>Clave</th>
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
                                <td>{{($user->activos==1)?'Habilitado':'Desabilitado'}}</td>
                                <td width="100px">
                                    <a class="mr-1" href="{{route('users.reestablecer',$user)}}"><i class="fas fa-recycle greenr"></i></a>
                                    <a class="mr-1" href="{{route('Admin.users.edit',$user)}}"><i class="fas fa-user-edit"></i></a>
                                    <a href="#" onclick="eliminar({{$user->id}},'{{$user->email}}')"><i class="far fa-trash-alt dangerito" aria-hidden="true"></i></a>
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
