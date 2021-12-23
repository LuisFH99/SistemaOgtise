<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Persona;
use App\Models\Docente;
use App\Models\User;

class DocentesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('departamento.docentes');
    }

    /**p
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('departamento.creardocente');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $existe = DB::table('personas')->where('dni', $request->dni)->count();
        if ($existe == 0) {

            $persona = new Persona;
            $persona->dni = $request->dni;
            $persona->nombres = $request->nombres;
            $persona->apellPat = $request->apepat;
            $persona->apellMat = $request->apemat;
            $persona->fechNacimiento = $request->fnacimiento;
            $persona->correo = $request->email;
            $persona->telefono = $request->numcel;
            $persona->estado = 1;
            $persona->save();

            $docente = new Docente;
            $docente->clave = bin2hex(random_bytes(4));
            $docente->estado = 1;
            $docente->fk_idPersonas = DB::table('personas')->where('dni', $request->dni)->pluck('idpersonas')->first();
            $docente->fk_idCategorias = $request->categoria;
            $docente->fk_idCondiciones = $request->condicion;
            $docente->fk_idDedicaciones = $request->dedicacion;
            $docente->fk_idDepAcademicos = $request->dptoacademico;
            $docente->save();

            User::create([
                'name' => $request->nombres,
                'email' => $request->email,
                'password' => bcrypt($request->dni)
            ])->assignRole('Docente');

            return view('departamento.docentes');
        } else {
            return redirect()->route('creardocente')->with('info','El docente con DNI: ' . $request->dni . ' ya esta registrado')->withInput();
            // return 'El docente con DNI: ' . $request->dni . ' ya esta registrado';
        }
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
