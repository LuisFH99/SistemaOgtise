<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Administrativo;
use App\Models\Docente;
use App\Models\Persona;
use App\Models\cargo;
use Spatie\Permission\Models\Role;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Mail;
use App\Mail\CredencialesMailable;

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
    public function __construct()
    {
        $this->middleware('auth');
    }
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
            'dni' => 'required|min:8',
            'apepat' => 'required',
            
            'nombres'=> 'required',
            'fnacimiento'=> 'required|date',
            'numcel'=> 'required|integer|min:9',
            'email'=> 'required|email',
            'cargo'=> 'required|integer',
        ]);
        $idMsg='info';
        $Mensaje='Se creó el usuario: '.$request->nombres.' '.$request->apepat.' '.$request->apemat;
        $clave=bin2hex(random_bytes(4));
        $arrayInfo = ['user' => $request->email, 'docente' => $request->nombres . ' ' . $request->apepat . ' ' . $request->apemat, 'contra' => $request->dni, 'clave' => $clave];
        $cargo=Role::where('id',$request->cargo)->first();
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
                User::create([
                    'name' => $request->nombres.' '.$request->apepat.' '.$request->apemat,
                    'email' => $request->email,
                    'password' => bcrypt($request->dni)
                ])->assignRole($cargo->name);
                $idper=Persona::select('idPersonas')->where('DNI',$request->dni)->first();
                Administrativo::create([
                    'clave'         =>$clave, 
                    'estado'        =>1, 
                    'fk_idPersonas' =>$idper->idPersonas, 
                    'fk_idRoles'   =>$request->cargo
                ]);
                $correo = new CredencialesMailable($arrayInfo);
                Mail::to($request->email)->send($correo);
                
            }else{
                $idMsg='info1';
                $Mensaje='El email: '.$request->email.' ya existe, debe crear uno diferente';
            }
        }else{
            if(User::where('name', $request->nombres.' '.$request->apepat.' '.$request->apemat)->where('email', $request->email)->doesntExist()){
                Persona::where('DNI', $request->dni)->update(array('estado' => 1));
                User::create([
                    'name' => $request->nombres.' '.$request->apepat.' '.$request->apemat,
                    'email' => $request->email,
                    'password' => bcrypt($request->dni)
                ])->assignRole($cargo->name);
                $idper=Persona::select('idPersonas')->where('DNI',$request->dni)->first();
                Administrativo::where('fk_idPersonas', $idper->idPersonas)->update(array('fk_idRoles' => $request->cargo));
                $correo = new CredencialesMailable($arrayInfo);
                Mail::to($request->email)->send($correo);
            }else{
                $idMsg='info1';
                $Mensaje='El usuario '.$request->nombres.' '.$request->apepat.' '.$request->apemat.' ya existe, debe crear uno diferente'; 
            }
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
        $request->validate([
            'dni' => 'required|integer',
            'apepat' => 'required',
            
            'nombres'=> 'required',
            'fnacimiento'=> 'required|date',
            'numcel'=> 'required|integer',
            'email'=> 'required|email',
            'idper'=> 'integer',
            'bdr'=> 'integer',
        ]);
        $idMsg='info';
        $Mensaje='Se editó el usuario: '.$request->nombres.' '.$request->apepat.' '.$request->apemat;
        if ($request->bdr==0) {
            $user->roles()->sync($request->roles);
            $Mensaje='Se asignó un rol al usuario: '.$request->nombres.' '.$request->apepat.' '.$request->apemat;
        } else {
            if($request->bdr==1){
                if(Persona::where('correo', $request->email)->count()<2){
                    Persona::where('idPersonas', $request->idper)->update(array(
                        'DNI'           =>$request->dni,
                        'nombres'       =>$request->nombres,
                        'apellPat'      =>$request->apepat,
                        'apellMat'      =>$request->apemat,
                        'fechNacimiento'=>$request->fnacimiento,
                        'correo'        =>$request->email,
                        'telefono'      =>$request->numcel,
                        'estado'        =>1
                    ));
                    User::where('id', $user->id)->update(array(
                        'name' => $request->nombres.' '.$request->apepat.' '.$request->apemat,
                        'email' => $request->email,
                        'password' => bcrypt($request->dni)
                    ));
                    $valor=0;
                    foreach ($request->roles as $value) {
                        $valor=$value;
                    }
                    Administrativo::where('fk_idPersonas', $request->idper)->update(array(
                        'fk_idRoles'   =>$valor
                    ));
                    $user->roles()->sync($request->roles);
                }else{
                    $idMsg='info1';
                    $Mensaje='El email: '.$request->email.' ya existe, debe crear uno diferente';
                }
            }else{
                $idMsg='info1';
                $Mensaje='No se puede editar';
            }
        }
        $cargos=Role::where('id','>',4)->pluck('name','id');
        return redirect()->route('Users',compact('cargos'))->with($idMsg,$Mensaje);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
    public function eliminar(Request $request)
    {
        $us = User::find($request->idu);
        $us->delete();
        $pe=Persona::where('correo', $request->correo)->update(array('estado' => 0));
        

        return $pe;
    }
    public function reestablecer(User $user){
        $pers=Persona::where('correo','=', ''.$user->email.'')->first();
        $clav='-';
        $doc=Docente::where('fk_idPersonas', $pers->idPersonas)->count();
        $adm=Administrativo::where('fk_idPersonas', $pers->idPersonas)->count();
        $pe=User::where('email', $user->email)->update(array('password' => bcrypt($pers->DNI)));
        if($doc==1){
            $clav=Docente::select('clave')->where('fk_idPersonas', $pers->idPersonas)->first();
        }
        if($adm==1){
            $clav=Administrativo::select('clave')->where('fk_idPersonas', $pers->idPersonas)->first();
        }
        $arrayInfo = ['user' => $user->email, 'docente' => $pers->nombres . ' ' . $pers->apepat . ' ' . $pers->apemat, 'contra' => $pers->DNI, 'clave' => $clav->clave];
        $correo = new CredencialesMailable($arrayInfo);
        Mail::to($user->email)->send($correo);
        $cargos=Role::where('id','>',4)->pluck('name','id');
        $idMsg='info';
        $Mensaje='Las credenciales han sido reestablecidas para: '.$user->name;
        return redirect()->route('Users',compact('cargos'))->with($idMsg,$Mensaje);
    }
}
