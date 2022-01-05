<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Persona;
use App\Models\Docente;
use App\Models\Solicitud;
use App\Models\MotivoSolicitud;
use App\Models\EstadoSolicitud;
use App\Models\Firma;
use App\Models\TipFirma;
use App\Models\Adjunto;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class ValidaLicenciaIndex extends Component
{
    use WithPagination;
    public $search; public $user; public $estado; public $bdr;
    //public $var=1; 
    protected $paginationTheme = "bootstrap";
    public function updatingSearch(){
        $this->resetPage();
    }
    public function render()
    {
        $user=auth()->user();
        if ($this->bdr==0) {
            $Dpto = Docente::join('personas', 'docentes.fk_idPersonas', '=', 'personas.idPersonas')
                ->join('depacademicos', 'docentes.fk_idDepAcademicos', '=', 'depacademicos.idDepAcademicos')
                ->join('facultades', 'depacademicos.fk_idFacultades', '=', 'facultades.id_Facultades')
                ->select('idDepAcademicos')->where('personas.correo',$user->email)->first();
            $licencias=Solicitud::join('estadosolicitudes', 'solicitudes.fk_idEstadoSolicitudes', '=', 'estadosolicitudes.idEstadoSolicitudes')
                ->join('motivosolicitudes', 'solicitudes.fk_idMotivoSolicitudes', '=', 'motivosolicitudes.idMotivoSolicitudes')
                ->join('docentes', 'solicitudes.fk_idDocentes', '=', 'docentes.idDocentes')
                ->join('personas', 'docentes.fk_idPersonas', '=', 'personas.idPersonas')
                ->join('depacademicos', 'docentes.fk_idDepAcademicos', '=', 'depacademicos.idDepAcademicos')
                ->select('solicitudes.*','estadosolicitudes.estadoSol','motivosolicitudes.motivo',
                    'personas.*','depacademicos.nomdep')
                ->where('idDepAcademicos',$Dpto->idDepAcademicos)->where('estadoSol',$this->estado)
                ->where(function ($query) {
                    $query->orWhere(DB::raw('CONCAT(apellPat," ",apellMat," ",nombres)'),'LIKE','%'.$this->search.'%')
                          ->orWhere('estadosolicitudes.estadoSol','LIKE','%'.$this->search.'%')
                          ->orWhere('motivosolicitudes.motivo','LIKE','%'.$this->search.'%')
                          ->orWhere('fech_solicitud','LIKE','%'.$this->search.'%')
                          ->orWhere('fech_retorno','LIKE','%'.$this->search.'%')
                          ->orWhere('codigo','LIKE','%'.$this->search.'%');
                })
                ->get();
        } else {
            $licencias=Solicitud::join('estadosolicitudes', 'solicitudes.fk_idEstadoSolicitudes', '=', 'estadosolicitudes.idEstadoSolicitudes')
                ->join('motivosolicitudes', 'solicitudes.fk_idMotivoSolicitudes', '=', 'motivosolicitudes.idMotivoSolicitudes')
                ->join('docentes', 'solicitudes.fk_idDocentes', '=', 'docentes.idDocentes')
                ->join('personas', 'docentes.fk_idPersonas', '=', 'personas.idPersonas')
                ->join('depacademicos', 'docentes.fk_idDepAcademicos', '=', 'depacademicos.idDepAcademicos')
                ->select('solicitudes.*','estadosolicitudes.estadoSol','motivosolicitudes.motivo',
                    'personas.*','depacademicos.nomdep')->where('estadoSol',$this->estado)
                ->where(function ($query) {
                    $query->orWhere(DB::raw('CONCAT(apellPat," ",apellMat," ",nombres)'),'LIKE','%'.$this->search.'%')
                            ->orWhere('estadosolicitudes.estadoSol','LIKE','%'.$this->search.'%')
                            ->orWhere('motivosolicitudes.motivo','LIKE','%'.$this->search.'%')
                            ->orWhere('fech_solicitud','LIKE','%'.$this->search.'%')
                            ->orWhere('fech_retorno','LIKE','%'.$this->search.'%')
                            ->orWhere('codigo','LIKE','%'.$this->search.'%');
                })
                ->paginate();
        }
        
        

        return view('livewire.valida-licencia-index',compact('licencias'));
    }
    public function datos(Request $request){
        $soli=DB::table('solicitudes')->where('idSolicitudes',$request->dt)->first();
        return $soli;
        
    }
}
