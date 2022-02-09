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
                <th scope="col" >Acciones</th>
            </tr>
        </thead>
        <tbody>
            @php
                $num = 1;
            @endphp
            @foreach ($docentes as $docente)
                <tr>
                    <td>{{ $num++ }}</td>
                    <td>{{ $docente->nombres }}</td>
                    <td>{{ $docente->dni }}</td>
                    <td>{{ $docente->correo }}</td>
                    <td>{{ $docente->telefono }}</td>
                    <td>{{ $docente->nomfac }}</td>
                    <td>{{ $docente->nomdep }}</td>
                    <td>{{ $docente->nomcondi }}</td>
                    <td>{{ $docente->nomcat }}</td>
                    <td>{{ $docente->nomdedi }}</td>
                    <td width="100px">

                        <i class="fas fa-user-edit btn-primary btn-sm"
                            onclick="MostarModal({{ $docente->idpersonas }})" title="Editar"></i>

                        <a href="{{ route('docentes.editSemana', $docente->iddocentes) }}"><i class="far fa-calendar-alt btn-secondary btn-sm" title="Dias laborales"></i></a>

                        {{-- <a href="{{route('docentes.suspenderDocente',$docente->iddocentes)}}"><i class="fas fa-user-slash" title="Suspender"></i></a> --}}

                       
                        <i class="far fa-trash-alt btn-danger btn-sm"
                            onclick="EliminarDocente({{ $docente->dni }},{{ $docente->id }},{{ $docente->idpersonas }})"
                            title="Eliminar"></i>
                        



                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
</div>
