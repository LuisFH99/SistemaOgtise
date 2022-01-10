<div>
    <div class="card"><br>
        <div class="input-group rounded col-6">
            <input wire:model="search" type="search" class="form-control rounded" placeholder="Buscar" aria-label="Search"
            aria-describedby="search-addon" />
            <span class="input-group-text border-0" id="search-addon">
              <i class="fas fa-search"></i>
            </span>
        </div>
        
        @if($users->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Email</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr>
                                <td>{{$user->id}}</td>
                                <td>{{$user->name}}</td>
                                <td>{{$user->email}}</td>
                                <td width="10px">
                                    <a class="btn btn-primary" href="{{route('Admin.users.edit',$user)}}">Editar</a>
                                    {{-- <a class="btn btn-primary" href="#" 
                                        onclick="selectId({{$user->id}})" 
                                         wire:model="iuser" 
                                        >Editar</a> --}}
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
    <!-- Modal2 -->
    {{-- <div class="modal fade bd-example-modal-lg" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="false">
        <div class="modal-dialog modal-lg">
            @if($var==0)
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img class="rounded mx-auto d-block" src="https://upload.wikimedia.org/wikipedia/commons/3/34/ErrorMessage.png" width="100" height="100">
                        <center><h1 class="modal-title text-danger" id="exampleModalLabel">Error</h1></center>
                        <br>
                        
                            <center><p class="text-secondary">Verifique su seleccion de usuario</p></center>
                    </div>
                    <div class="modal-footer">
                    <button type="button" class="btn btn-outline-danger " data-dismiss="modal">Aceptar</button>
                    </div>
                </div>
            @else
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Asignar Roles</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body" id="idBodyModel">
                            <input id="prodId" name="prodId" type="hidden">
                            <p class="h5">Nombre:</p>
                            <p class="form-control" id="idNombre"></p>
                            <h5>Listado de Roles:</h5> --}}
                            {{-- {!! Form::model($us,['route' => ['Admin.users.update',$us],'method'=>'put']) !!} --}}
                            {{-- {!! Form::open() !!}
                            @foreach ($roles as $role)
                                <div>
                                    <label>
                                        
                                        {!! Form::checkbox('roles[]', $role->id, null, ['class'=>'mr-1','id'=>'idcheck'.$role->id]) !!}
                                        {{$role->name}}
                                    </label>
                                </div>
                            @endforeach --}}
                        {{-- {!! Form::submit('Asignar Rol', ['class'=>'btn btn-primary mt-2','data-dismiss'=>'modal']) !!}                
                        {!! Form::close() !!}  --}}
                        {{-- </div>
                    </div>
                </div>
                <div class="modal-footer"> --}}
                    <!--<button type="button" class="btn btn-outline-danger " data-dismiss="modal">Denegar</button>-->
                    {{-- <button type="button" class="btn btn-outline-primary " data-dismiss="modal">Aceptar</button> --}}
{{--                     
                </div>
            </div>
             @endif
        </div>
    </div>    --}}
</div>
