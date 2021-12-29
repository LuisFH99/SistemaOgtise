<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Persona;
use App\Models\Docente;
use App\Models\Asistencia;
use App\Models\AsistenciaSalida;
use App\Models\Firma;
use App\Models\TipFirma;
use App\Models\Evidencia;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
class ValidarSalidasIndex extends Component
{
    use WithPagination;
    public $search; public $user;
    //public $var=1; 
    protected $paginationTheme = "bootstrap";
    public function updatingSearch(){
        $this->resetPage();
    }
    public function render()
    {
        $idDep=Docente::join('depacademicos', 'docentes.fk_idDepAcademicos', '=', 'depacademicos.idDepAcademicos')
                        ->join('personas', 'docentes.fk_idPersonas', '=', 'personas.idPersonas')
                        ->select('idDepAcademicos')->where('personas.correo',$this->user->email)->first();
        $Salidas=Asistencia::join('asistenciasalidas', 'asistencias.fk_idAsistenciaSalidas', '=', 'asistenciasalidas.idAsistenciaSalidas')
        ->join('fechasistencias', 'asistencias.fk_idFechAsistencias', '=', 'fechasistencias.idFechAsistencias')
        ->join('estadoasistencias', 'asistencias.fk_idEstadoAsistencias', '=', 'estadoasistencias.idEstadoAsistencias')
        ->join('docentes', 'asistencias.fk_idDocentes', '=', 'docentes.idDocentes')
        ->join('personas', 'docentes.fk_idPersonas', '=', 'personas.idPersonas')
        ->join('depacademicos', 'docentes.fk_idDepAcademicos', '=', 'depacademicos.idDepAcademicos')
        ->join('facultades', 'depacademicos.fk_idFacultades', '=', 'facultades.id_Facultades')
        ->join('categorias', 'docentes.fk_idCategorias', '=', 'categorias.idCategorias')
        ->join('condiciones', 'docentes.fk_idCondiciones', '=', 'condiciones.idCondiciones')
        ->join('dedicaciones', 'docentes.fk_idDedicaciones', '=', 'dedicaciones.idDedicaciones')
        ->select('asistencias.observacion','asistenciasalidas.idAsistenciaSalidas','asistenciasalidas.hor_salida',
                 'asistenciasalidas.informe','fechasistencias.fecha','fechasistencias.dia',
                 'estadoasistencias.estado','personas.*','categorias.nomCat','condiciones.nomCondi',
                 'dedicaciones.nomDedi','depacademicos.nomdep','facultades.nomFac')
        ->where('personas.estado',1)->where('fk_idDepAcademicos',$idDep)->where('fecha',date('Y-m-d'))  
        ->where(DB::raw('CONCAT(apellPat," ",apellMat," ",nombres)'),'LIKE','%'.$this->search.'%')
        ->Where('fecha','LIKE','%'.$this->search.'%')->Where('asistencias.observacion','LIKE','%'.$this->search.'%')
        //->orderBy('idSolicitudes', 'desc')
        ->get();
        return view('livewire.validar-salidas-index',compact('Salidas'));
    }
    public function validando(Request $request){
        $idSal=$request->idSalida;
        $Salida=Asistencia::join('asistenciasalidas', 'asistencias.fk_idAsistenciaSalidas', '=', 'asistenciasalidas.idAsistenciaSalidas')
        ->join('evidencias', 'asistenciasalidas.idAsistenciaSalidas', '=', 'evidencias.fk_idAsistenciaSalidas')
        ->join('fechasistencias', 'asistencias.fk_idFechAsistencias', '=', 'fechasistencias.idFechAsistencias')
        ->join('docentes', 'asistencias.fk_idDocentes', '=', 'docentes.idDocentes')
        ->join('personas', 'docentes.fk_idPersonas', '=', 'personas.idPersonas')
        ->select('asistencias.observacion','asistenciasalidas.idAsistenciaSalidas','asistenciasalidas.hor_salida',
                 'asistenciasalidas.informe','fechasistencias.fecha','fechasistencias.dia',
                 'personas.*')
        ->where('idAsistenciaSalidas',$idSal)->first();

        $evi=Evidencia::where('fk_idAsistenciaSalidas',$idSal)->get();
        $dat=compact('Salida','evi');
        return $dat;
        
    }
}
