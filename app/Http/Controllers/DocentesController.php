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
use App\Models\autoridad;
use App\Models\cargo;
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
                'name' => $request->nombres . ' ' . $request->apepat . ' ' . $request->apemat,
                'email' => $request->email,
                'password' => bcrypt($request->dni)
            ])->assignRole('Docente');
            return redirect()->route('docentes');
        } else {
            if ($existe2 > 0) {
                DB::insert('call p_crear_docente(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [4, $request->dni, $request->nombres, $request->apepat, $request->apemat, $request->fnacimiento, $request->numcel, bin2hex(random_bytes(4)), $request->condicion, $request->categoria, $request->dedicacion, $request->dptoacademico, 0, '0', 0, $request->email]);
                User::create([
                    'name' => $request->nombres . ' ' . $request->apepat . ' ' . $request->apemat,
                    'email' => $request->email,
                    'password' => bcrypt($request->dni)
                ])->assignRole('Docente');
                return redirect()->route('docentes');
            } else {
                return redirect()->route('creardocente')->with('info', 'El docente con DNI: ' . $request->dni . ' ya esta registrado')->withInput();
            }
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
        $DetSemanas = DetSemana::where('fk_idDocentes', $id)->get();
        $Persona = Docente::join('personas', 'docentes.fk_idpersonas', '=', 'personas.idpersonas')
            ->select('idDocentes', 'personas.nombres', 'personas.apellPat', 'personas.apellMat')
            ->where('idDocentes', $id)->first();
        $msg = "0";
        foreach ($DetSemanas as $DetSemana) :
            $msg = $msg . ',' . $DetSemana->fk_idSemanas;
        endforeach;
        $Semanas = Semana::all();
        $cargoDocente = autoridad::join('cargos', 'autoridades.fk_idcargos', '=', 'cargos.idcargos')
            ->select('cargos.idcargos', 'cargos.cargo')
            ->where('fk_iddocentes', $id)->first();
        $cargos = cargo::all();

        return view('departamento.DocentesSemanaEdit', compact('DetSemanas', 'Persona', 'Semanas', 'msg', 'cargoDocente', 'cargos'));
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
    public function updateSemana(Request $request, $id)
    {
        //$user->roles()->sync($request->roles);
        if ($request->id != 0) {
            if (DB::table('autoridades')->where('fk_idDocentes', $id)->exists()) {
                $eliminar = autoridad::where("fk_idDocentes", $id)->delete();
                autoridad::create([
                    'fk_idDocentes' => $id,
                    'fk_idCargos' => $request->id
                ]);
            }else{
                autoridad::create([
                    'fk_idDocentes' => $id,
                    'fk_idCargos' => $request->id
                ]);
            }
        }else{
            if (DB::table('autoridades')->where('fk_idDocentes', $id)->exists()) {
                $eliminar = autoridad::where("fk_idDocentes", $id)->delete();
            }
        }
        

        $respuesta = DetSemana::where('fk_idDocentes', $id)->delete();
        $Persona = Docente::join('personas', 'docentes.fk_idpersonas', '=', 'personas.idpersonas')
            ->select('personas.nombres', 'personas.apellPat', 'personas.apellMat')
            ->where('idDocentes', $id)->first();

        $prueba = "0";
        for ($i = 1; $i <= 5; $i++) {
            if ($request->has('cbox' . $i)) {
                $prueba = $prueba . ',' . $request->get('cbox' . $i);
                DetSemana::create([
                    'fk_idDocentes' => $id,
                    'fk_idSemanas'  => $request->get('cbox' . $i)
                ]);
            }
        }
        return view('departamento.docentes')->with('info', 'Se asignó los dias laborables al Docente: ' . $Persona->apellPat . ' ' . $Persona->apellMat . ' ' . $Persona->nombres);
    }

    public function CrearCargo($cargo)
    {
        if (DB::table('cargos')->where('cargo', $cargo)->doesntExist()) {
            cargo::create([
                'cargo' => $cargo,
            ]);
            return 1;
        } else {
            return 2;
        }
    }
    public function EliminarCargo(Request $request)
    {
        $rpta = 0;
        if ($request->ev == 1) {
            if (DB::table('autoridades')->where('fk_idCargos', $request->idcargo)->exists()) {
                $rpta = 0;
            } else {
                $rpta = cargo::where("idCargos", $request->idcargo)->delete();
            }
        } else {
            $rpta = autoridad::where("fk_idCargos", $request->idcargo)->delete();
            $rpta = cargo::where("idCargos", $request->idcargo)->delete();
        }
        return $rpta;
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
