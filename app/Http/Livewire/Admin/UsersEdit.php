<?php

namespace App\Http\Livewire\Admin;
use App\Models\User;
use App\Models\Persona;
use Spatie\Permission\Models\Role;
use Livewire\Component;
use App\Http\Livewire\Admin\UsersIndex;
class UsersEdit extends Component
{
    public $user1;
    
    
    public function render()
    {
        $roles=Role::all();
        $user=User::where('id',"=",$this->user1)->first();
        $Persona=Persona::where('correo',$user->email)->first();
        return view('livewire.admin.users-edit',compact('user','roles','Persona'));
    }

}
