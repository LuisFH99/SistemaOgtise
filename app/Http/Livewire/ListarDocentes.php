<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;



class ListarDocentes extends Component
{

    public function editar(){
        
    }

    public function render()
    {

        $docentes = DB::table('docentes')
            ->join('personas', 'docentes.fk_idpersonas', '=', 'personas.idpersonas')
            ->join('depacademicos', 'docentes.fk_idDepAcademicos', '=', 'depacademicos.iddepacademicos')
            ->join('facultades', 'depacademicos.fk_idfacultades', '=', 'facultades.id_facultades')
            ->join('condiciones', 'docentes.fk_idcondiciones', '=', 'condiciones.idcondiciones')
            ->join('categorias', 'docentes.fk_idcategorias', '=', 'categorias.idcategorias')
            ->join('dedicaciones', 'docentes.fk_iddedicaciones', '=', 'dedicaciones.iddedicaciones')
            ->join('users', 'personas.correo', '=', 'users.email')
            ->select('personas.idpersonas','personas.dni','docentes.iddocentes',DB::raw('concat_ws(" ",personas.apellpat,personas.apellmat,personas.nombres) as nombres'), 'personas.correo', 'personas.telefono', 'facultades.nomfac', 'depacademicos.nomdep', 'condiciones.nomcondi', 'categorias.nomcat', 'dedicaciones.nomdedi','users.id')->where('docentes.estado', 1)->where('personas.estado', 1)->orderBy('docentes.idDocentes','desc')->get();

        return view('livewire.listar-docentes', compact('docentes'));
    }

    
    
}
