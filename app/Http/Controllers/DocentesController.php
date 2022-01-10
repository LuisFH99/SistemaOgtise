<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Persona;
use App\Models\Docente;
use App\Models\Facultad;
use App\Models\User;
use App\Models\Semana;
use App\Models\DetSemana;
use Illuminate\Auth\Events\Validated;

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
        $request->validate([
           'dni' => 'required',
           'nombres' => 'required',
           'apepat' => 'required',
           'apemat' => 'required',
           'fnacimiento' => 'required',
           'numcel' => 'required',
           'condicion' => 'required',
           'categoria' => 'required',
           'dedicacion' => 'required',
           'dptoacademico' => 'required',
           'email' => 'required'  
        ]);

        $existe1 = DB::table('personas')->where('dni', $request->dni)->where('estado', 1)->count();
        $existe2 = DB::table('personas')->where('dni', $request->dni)->where('estado', 0)->count();


        if ($existe1 == 0 && $existe2 == 0) {
            DB::insert('call p_crear_docente(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [1, $request->dni, $request->nombres, $request->apepat, $request->apemat, $request->fnacimiento, $request->numcel, bin2hex(random_bytes(4)), $request->condicion, $request->categoria, $request->dedicacion, $request->dptoacademico, 0, '0', 0, $request->email]);
            User::create([
                'name' => $request->nombres.' '.$request->apepat.' '.$request->apemat,
                'email' => $request->email,
                'password' => bcrypt($request->dni)
            ])->assignRole('Docente');
            return redirect()->route('docentes');
        } else {
            if ($existe2 > 0) {
                DB::insert('call p_crear_docente(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [4, $request->dni, $request->nombres, $request->apepat, $request->apemat, $request->fnacimiento, $request->numcel, bin2hex(random_bytes(4)), $request->condicion, $request->categoria, $request->dedicacion, $request->dptoacademico, 0, '0', 0, $request->email]);
                User::create([
                    'name' => $request->nombres.' '.$request->apepat.' '.$request->apemat,
                    'email' => $request->email,
                    'password' => bcrypt($request->dni)
                ])->assignRole('Docente');
                return redirect()->route('docentes');
            } else {
                return redirect()->route('creardocente')->with('info', 'El docente con DNI: ' . $request->dni . ' ya esta registrado')->withInput();
            }
        }

        //if (($existe1 == 0) && ($existe2 == 0)) {

        /*$persona = new Persona;
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
            $docente->save();*/

        /* $respuesta = DB::select('call p_crear_docente(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [1, $request->dni, $request->nombres, $request->apepat, $request->apemat, $request->fnacimiento, $request->numcel, bin2hex(random_bytes(4)), $request->condicion, $request->categoria, $request->dedicacion, $request->dptoacademico, 0, 0, 0, $request->email]);
           
            if ($respuesta[0]->rpta == 1) {
                User::create([
                    'name' => $request->nombres,
                    'email' => $request->email,
                    'password' => bcrypt($request->dni)
                ])->assignRole('Docente');

                //return view('departamento.docentes');
            }
        } else {
            //return redirect()->route('creardocente')->with('info', 'El docente con DNI: ' . $request->dni . ' ya esta registrado')->withInput();
            // return 'El docente con DNI: ' . $request->dni . ' ya esta registrado';
        }*/
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
    public function edit(Request $request)
    {

        $docente = DB::table('docentes')
            ->join('personas', 'docentes.fk_idpersonas', '=', 'personas.idpersonas')
            ->join('depacademicos', 'docentes.fk_idDepAcademicos', '=', 'depacademicos.iddepacademicos')
            ->join('facultades', 'depacademicos.fk_idfacultades', '=', 'facultades.id_facultades')
            ->join('condiciones', 'docentes.fk_idcondiciones', '=', 'condiciones.idcondiciones')
            ->join('categorias', 'docentes.fk_idcategorias', '=', 'categorias.idcategorias')
            ->join('dedicaciones', 'docentes.fk_iddedicaciones', '=', 'dedicaciones.iddedicaciones')
            ->join('users', 'personas.correo', '=', 'users.email')
            ->select('personas.idpersonas', 'personas.dni', 'personas.apellpat', 'personas.apellmat', 'personas.nombres', 'personas.fechNacimiento', 'personas.correo', 'personas.telefono', 'docentes.clave', 'facultades.id_facultades', 'depacademicos.idDepAcademicos', 'condiciones.idCondiciones', 'categorias.idCategorias', 'dedicaciones.iddedicaciones', 'users.id')->where('personas.idpersonas', $request->idper)->get();

        $facultades = DB::table('facultades')
            ->select('id_facultades', 'nomfac')
            ->get();
        $dptos = DB::table('depacademicos')->where('fk_idfacultades', $docente[0]->id_facultades)
            ->select('idDepAcademicos', 'nomdep')
            ->get();
        $condiciones = DB::table('condiciones')
            ->select('idcondiciones', 'nomcondi')
            ->get();
        $categorias = DB::table('categorias')
            ->select('idcategorias', 'nomcat')
            ->get();

        $dedicaciones = DB::table('dedicaciones')
            ->select('iddedicaciones', 'nomdedi')
            ->get();

        return compact('docente', 'facultades', 'dptos', 'condiciones', 'categorias', 'dedicaciones');
    }
    public function editSemana($id)
    {
        $DetSemanas=DetSemana::where('fk_idDocentes',$id)->get();
        $Persona=Docente::join('personas', 'docentes.fk_idpersonas', '=', 'personas.idpersonas')
                    ->select('idDocentes','personas.nombres', 'personas.apellPat', 'personas.apellMat')
                    ->where('idDocentes',$id)->first();
        $msg="0";
        foreach($DetSemanas as $DetSemana):
            $msg=$msg.','.$DetSemana->fk_idSemanas;
        endforeach;
        $Semanas=Semana::all();
        return view('departamento.DocentesSemanaEdit',compact('DetSemanas','Persona','Semanas','msg'));
    }
    public function dpto(Request $request)
    {
        $dptos = DB::table('depacademicos')->where('fk_idfacultades', $request->idfac)
            ->select('idDepAcademicos', 'nomdep')
            ->get();
        return compact('dptos');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $respuesta = DB::select('call p_crear_docente(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [$request->ev, $request->dni, $request->nombre, $request->appat, $request->apmat, $request->fnac, $request->cel, $request->clv, $request->idcnd, $request->idcat, $request->iddedi, $request->iddep, $request->idper, bcrypt($request->dni), $request->idusu, $request->correo]);
        return $respuesta;
    }
    public function updateSemana(Request $request,$id)
    {
        //$user->roles()->sync($request->roles);
        $respuesta =DetSemana::where('fk_idDocentes', $id)->delete();
        $Persona=Docente::join('personas', 'docentes.fk_idpersonas', '=', 'personas.idpersonas')
                    ->select('personas.nombres', 'personas.apellPat', 'personas.apellMat')
                    ->where('idDocentes',$id)->first();
        
        $prueba="0";
        for ($i=1; $i <=5 ; $i++) { 
            if($request->has('cbox'.$i)){
                $prueba=$prueba.','.$request->get('cbox'.$i);
                DetSemana::create([
                    'fk_idDocentes' =>$id,
                    'fk_idSemanas'  =>$request->get('cbox'.$i)
                ]);
            }
        }
        return view('departamento.docentes')->with('info','Se asignó los dias laborables al Docente: '.$Persona->apellPat.' '.$Persona->apellMat.' '.$Persona->nombres);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $respuesta = DB::select('call p_crear_docente(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [$request->ev, $request->dni, "1", "1", "1", "2000-10-10", "1", "1", "1", "1", "1", "1", $request->idper, "1", $request->idusu, "1"]);
        return $respuesta;
    }
}
