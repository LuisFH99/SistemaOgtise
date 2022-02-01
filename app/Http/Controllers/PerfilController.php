<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;

class PerfilController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $user=auth()->user();
        return view('Perfiles',compact('user'));
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
            'passwordA' => 'required|min:6',
            'passwordN' => 'required|min:6',
            'passwordC'=> 'required_with:passwordN|same:passwordN|min:6',
        ]);
        $user=auth()->user();
        $idMsg='info';
        $Mensaje='La contraseña se ha cambiado Correctamente: ';
        if(Hash::check($request->passwordA,$user->password)==1){
            if(strcmp($request->passwordN, $request->passwordC) === 0){
                User::where('id', $user->id)->update(array('password' => Hash::make($request->passwordC)));
                $idMsg='info';
                $Mensaje='La contraseña se ha cambiado Correctamente';
            }else{
                $idMsg='info1';
                $Mensaje='La nueva contraseña no coincide';
            }
        }else{
            $idMsg='info1';
            $Mensaje='No se puede cambiar de contraseña';
        }
        return redirect()->route('Perfiles',compact('user'))->with($idMsg,$Mensaje);
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
}
