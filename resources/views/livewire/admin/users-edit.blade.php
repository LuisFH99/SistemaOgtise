
<div class="modal-content">
    {!! Form::model($user,['route' => ['Admin.users.update',$user],'method'=>'put']) !!}
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Asignar Roles</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="card">
            <div class="card-body">
                <input id="prodId" name="prodId" type="hidden">
                <p class="h5">Nombre:</p>
                <p class="form-control">{{$user->name}}</p>
                <h5>Listado de Roles:</h5>
                
                    @foreach ($roles as $role)
                        <div>
                            <label>
                                {!! Form::checkbox('roles[]', $role->id, null, ['class'=>'mr-1']) !!}
                                {{$role->name}}
                            </label>
                        </div>
                    @endforeach
                    
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <!--<button type="button" class="btn btn-outline-danger " data-dismiss="modal">Denegar</button>-->
        {{-- <button type="button" class="btn btn-outline-primary " data-dismiss="modal">Aceptar</button> --}}
        {!! Form::submit('Asignar Rol', ['class'=>'btn btn-primary mt-2','data-dismiss'=>'modal']) !!}                
        {!! Form::close() !!} 
    </div>
</div>
