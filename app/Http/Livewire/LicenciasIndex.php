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
        $solicitudes=DB::table('solicitudes')
            ->join('estadosolicitudes', 'solicitudes.fk_idEstadoSolicitudes', '=', 'estadosolicitudes.idEstadoSolicitudes')
            ->select('solicitudes.*','estadosolicitudes.estado')->where('fk_idDocentes',$docente->idDocentes)->get();
        return view('livewire.licencias-index',compact('solicitudes'));
    }
    public function datos(Request $request){
        $soli=DB::table('solicitudes')->where('idSolicitudes',1)->first();
        return $soli;
        
    }
}
