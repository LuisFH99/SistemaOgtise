<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Persona;
use App\Models\Docente;
use App\Models\Solicitud;
use App\Models\DetAdjunto;
use App\Models\Adjunto;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
class LicenciasIndex extends Component
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
        $docente = DB::table('docentes')
            ->join('personas', 'docentes.fk_idPersonas', '=', 'personas.idPersonas')
            ->select('idDocentes')->where('correo',$this->user->email)->first();
            $aux=-1;
        if(isset($docente)){
            $solicitudes=DB::table('solicitudes')
            ->join('estadosolicitudes', 'solicitudes.fk_idEstadoSolicitudes', '=', 'estadosolicitudes.idEstadoSolicitudes')
            ->select('solicitudes.*','estadosolicitudes.estadoSol')->where('fk_idDocentes',$docente->idDocentes)->orderBy('idSolicitudes', 'desc')->get();
            $aux=1;
        }else{
            $solicitudes=[['idSolicitudes'=>0]];$aux=0;
            //$solicitudes=['idSolicitudes'=>1,'fech_solicitud'=>'1','hor_solicitud'=>'1','estado'=>'1'];
            //return view('livewire.licencias-index')->with('info','No hay Solicitudes a mostrar');
        }
        return view('livewire.licencias-index',compact('solicitudes','aux'));
    }
    public function datos(Request $request){
        $soli=DB::table('solicitudes')->where('idSolicitudes',$request->dt)->first();
        return $soli;
        
    }
}
