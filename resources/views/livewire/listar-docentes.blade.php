<div class="row">
    {{-- {{ $docentes }} --}}
    <a href="{{ route('creardocente') }}" class="btn btn-primary my-2">Registar Docente</a>
    <table id="tableDocentes" class="table table-sm shadow-lg">
        <thead class="text-white">
            <tr>
                <th scope="col">N°</th>
                <th scope="col">Apellidos y Nombres</th>
                <th scope="col">Correo</th>
                <th scope="col">Celular</th>
                <th scope="col">Facultad</th>
                <th scope="col">Depatameto Académico</th>
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
                    <td>{{$docente->correo}}</td>
                    <td>{{$docente->telefono}}</td>
                    <td>{{$docente->nomfac}}</td>
                    <td>{{$docente->nomdep}}</td>
                    <td>{{$docente->nomcondi}}</td>
                    <td>{{$docente->nomcat}}</td>
                    <td>{{$docente->nomdedi}}</td>
                    <td>
                        <span><i class="fas fa-eye mr-2" onclick="saludo({{$docente->iddocentes}})"></i></span>
                        <span><i class="far fa-trash-alt" onclick="saludo({{$docente->iddocentes}})"></i></span>
                    </td>
                </tr>
            @endforeach
            
        </tbody>
    </table>
</div>
