<?php

namespace App\Http\Livewire\Admin;
use App\Models\User;
use App\Models\Persona;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
class UsersIndex extends Component
{
    use WithPagination;
    public $search; public User $us;
    public $var=1; 
    protected $paginationTheme = "bootstrap";
    public function updatingSearch(){
        $this->resetPage();
    }
    
    public function render()
    {   
        $roles=Role::all();
        //$us=User::where('id','=',1)->first();
        $users1=User::join('personas', 'users.email', '=', 'personas.correo')
                    ->join('docentes', 'personas.idpersonas', '=', 'docentes.fk_idpersonas')
                    ->select('users.*','personas.DNI','docentes.clave',DB::raw('"Docente" as tipo'))
                    ->where('name','LIKE','%'.$this->search.'%')
                    ->orWhere('email','LIKE','%'.$this->search.'%')
                    ->orWhere('DNI','LIKE','%'.$this->search.'%');
        $users=User::join('personas', 'users.email', '=', 'personas.correo')
                    ->join('administrativos', 'personas.idpersonas', '=', 'administrativos.fk_idpersonas')
                    ->select('users.*','personas.DNI','administrativos.clave',DB::raw('"Administrativo" as tipo'))
                    ->where('name','LIKE','%'.$this->search.'%')
                    ->orWhere('email','LIKE','%'.$this->search.'%')
                    ->orWhere('DNI','LIKE','%'.$this->search.'%')
                    ->union($users1)
                    ->paginate();
        return view('livewire.admin.users-index',compact('users','roles'));
    }
    public function datos(Request $request){
        $this->var=$request->dt;
        //$roles=Role::all();
        $us=User::where('id',$this->var)->first();
        //$st=''.$userd->id.','.$userd->name;
        return $us;
        
    }
    public function devolverRoles( User $us){
        $nroles = $us->getRoleNames();
        $roles = Role::where('name','=',$nroles);
        return $roles;
        
    }
}