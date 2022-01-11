<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Administrativo;
use App\Models\Persona;
use App\Models\cargo;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*public function __construct(){
        $this->middleware(['can:admin.users.index'])->only('index');
        $this->middleware(['can:admin.users.edit'])->only('edit','update');
    }*/

    public function index()
    {
        $cargos=Role::where('id','>',4)->pluck('name','id');
        return view('users.index',compact('cargos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'dni' => 'required|integer',
            'apepat' => 'required',
            'apemat' => 'required',
            'nombres'=> 'required',
            'fnacimiento'=> 'required|date',
            'numcel'=> 'required|integer',
            'email'=> 'required|email',
            'cargo'=> 'required|integer',
        ]);
        $idMsg='info';
        $Mensaje='Se creo el usuario: '.$request->nombres.' '.$request->apepat.' '.$request->apemat;
        if(Persona::where('DNI', $request->dni)->doesntExist()){
            if(Persona::where('correo', $request->email)->doesntExist()){
                Persona::create([
                    'DNI'           =>$request->dni,
                    'nombres'       =>$request->nombres,
                    'apellPat'      =>$request->apepat,
                    'apellMat'      =>$request->apemat,
                    'fechNacimiento'=>$request->fnacimiento,
                    'correo'        =>$request->email,
                    'telefono'      =>$request->numcel,
                    'estado'        =>1
                ]);
                $cargo=Role::where('id',$request->cargo)->first();
                User::create([
                    'name' => $Mensaje,
                    'email' => $request->email,
                    'password' => bcrypt($request->dni)
                ])->assignRole($cargo->name);
                $idper=Persona::select('idPersonas')->where('DNI',$request->dni)->first();
                Administrativo::create([
                    'clave'         =>bin2hex(random_bytes(4)), 
                    'estado'        =>1, 
                    'fk_idPersonas' =>$idper->idPersonas, 
                    'fk_idRoles'   =>$request->cargo
                ]);
            }else{
                $idMsg='info1';
                $Mensaje='El email ya existe, debe crear uno diferente';
            }
        }else{
            Persona::where('DNI', $request->dni)->update(array('estado' => 1));
        }

        
        $cargos=Role::where('id','>',4)->pluck('name','id');
        return redirect()->route('Users',compact('cargos'))->with($idMsg,$Mensaje);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {   
        $roles=Role::all();
        return view('users.edit',compact('user','roles'));
        //return view('users.index',compact('user'));
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,User $user)
    {
        $user->roles()->sync($request->roles);
        $cargos=Role::where('id','>',4)->pluck('name','id');
        return redirect()->route('Users',compact('cargos'))->with('info','Se asignó un rol al usuario: '.$user->name);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
