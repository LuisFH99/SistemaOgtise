<div class="row table-responsive">
    {{-- {{ $docentes }} --}}
    {{-- <a href="{{ route('creardocente') }}" class="btn btn-primary my-2">Registar Docente</a> --}}
  
    <table id="tableDocentes" class="table table-sm shadow-lg">
        <thead class="text-white">
            <tr>
                <th scope="col">N°</th>
                <th scope="col">Apellidos y Nombres</th>
                <th scope="col">DNI</th>
                <th scope="col">Correo</th>
                <th scope="col">Celular</th>
                <th scope="col">Facultad</th>
                <th scope="col">Departamento Académico</th>
                <th scope="col">Condición</th>
                <th scope="col">Categoria</th>
                <th scope="col">Dedicación</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @php
                $num=1;
            @endphp
            @foreach ($docentes as $docente)
                <tr>
                    <td>{{$num++}}</td>
                    <td>{{$docente->nombres}}</td>
                    <td>{{$docente->dni}}</td>
                    <td>{{$docente->correo}}</td>
                    <td>{{$docente->telefono}}</td>
                    <td>{{$docente->nomfac}}</td>
                    <td>{{$docente->nomdep}}</td>
                    <td>{{$docente->nomcondi}}</td>
                    <td>{{$docente->nomcat}}</td>
                    <td>{{$docente->nomdedi}}</td>
                    <td>
                        <span><i class="fas fa-user-edit mr-1" onclick="MostarModal({{$docente->idpersonas}})" title="Editar"></i></span>
                        <a href="{{route('docentes.editSemana',$docente->iddocentes)}}"><i class="far fa-calendar-alt mr-1" title="Dias laborales"></i></a>
                        {{-- <a href="{{route('docentes.suspenderDocente',$docente->iddocentes)}}"><i class="fas fa-user-slash" title="Suspender"></i></a> --}}
                        <span><i class="far fa-trash-alt" onclick="EliminarDocente({{$docente->dni}},{{$docente->id}},{{$docente->idpersonas}})" title="Eliminar"></i></span>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
