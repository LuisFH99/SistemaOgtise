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
use App\Models\Categoria;
use App\Models\Dedicacion;
use App\Models\Condicion;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Mail;
use App\Mail\CredencialesMailable;

class DocentesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $condiciones = Condicion::all();
        $categorias = Categoria::all();
        $dedicaciones = Dedicacion::all();

        return view('departamento.docentes', compact('condiciones', 'categorias', 'dedicaciones'));
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
            'dni' => 'required|min:8',
            'nombres' => 'required',
            'apepat' => 'required',
            'fnacimiento' => 'required|date',
            'numcel' => 'required|integer|min:9',
            'condicion' => 'required|integer',
            'categoria' => 'required|integer',
            'dedicacion' => 'required|integer',
            'dptoacademico' => 'required|integer',
            'correo' => 'required|email|unique:personas|regex:/(.*)@unasam\.edu\.pe$/i'
        ]);

        $existe1 = DB::table('personas')->where('dni', $request->dni)->where('estado', 1)->count();
        $existe2 = DB::table('personas')->where('dni', $request->dni)->where('estado', 0)->count();
        $clave = bin2hex(random_bytes(4));


        if ($existe1 == 0 && $existe2 == 0) {
            DB::insert('call p_crear_docente(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [1, $request->dni, $request->nombres, $request->apepat, $request->apemat, $request->fnacimiento, $request->numcel, $clave, $request->condicion, $request->categoria, $request->dedicacion, $request->dptoacademico, 0, '0', 0, $request->email, '1']);
            User::create([
                'name' => $request->nombres . ' ' . $request->apepat . ' ' . $request->apemat,
                'email' => $request->email,
                'password' => bcrypt($request->dni),
                'activos' => 1
            ])->assignRole('Docente');

            $arrayInfo = ['user' => $request->email, 'docente' => $request->nombres . ' ' . $request->apepat . ' ' . $request->apemat, 'contra' => $request->dni, 'clave' => $clave];
            $correo = new CredencialesMailable($arrayInfo);
            Mail::to($request->email)->send($correo);

            return redirect()->route('docentes')->with('success', 'El docente fue registrado con Exito')->withInput();
        } else {
            if ($existe2 > 0) {
                DB::insert('call p_crear_docente(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [4, $request->dni, $request->nombres, $request->apepat, $request->apemat, $request->fnacimiento, $request->numcel, $clave, $request->condicion, $request->categoria, $request->dedicacion, $request->dptoacademico, 0, '0', 0, $request->email, '1']);
                User::create([
                    'name' => $request->nombres . ' ' . $request->apepat . ' ' . $request->apemat,
                    'email' => $request->email,
                    'password' => bcrypt($request->dni),
                    'activos' => 1
                ])->assignRole('Docente');

                $arrayInfo = ['user' => $request->email, 'docente' => $request->nombres . ' ' . $request->apepat . ' ' . $request->apemat, 'contra' => $request->dni, 'clave' => $clave];
                $correo = new CredencialesMailable($arrayInfo);
                Mail::to($request->email)->send($correo);

                return redirect()->route('docentes')->with('success', 'El docente fue registrado con Exito')->withInput();
            } else {
                return redirect()->route('docentes')->with('info', 'El docente con DNI: ' . $request->dni . ' ya esta registrado')->withInput();
            }
        }
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendEmail(Request $request)
    {
        $arrayInfo = ['user' => $request->email, 'docente' => $request->nombres . ' ' . $request->apepat . ' ' . $request->apemat, 'contra' => $request->dni, 'clave' => $request->clave];
        $correo = new CredencialesMailable($arrayInfo);
        Mail::to($request->email)->send($correo);
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
            ->select('idDocentes', 'personas.nombres', 'personas.apellPat', 'personas.apellMat', DB::raw('curdate() as dia'))
            ->where('idDocentes', $id)->first();
        $msg = "0";
        foreach ($DetSemanas as $DetSemana) :
            $msg = $msg . ',' . $DetSemana->fk_idSemanas;
        endforeach;
        $Semanas = Semana::all();

        $cargoDocente = autoridad::join('cargos', 'autoridades.fk_idcargos', '=', 'cargos.idcargos')
            ->select('cargos.idcargos', 'cargos.cargo', 'autoridades.fech_ini', 'autoridades.fech_fin')
            ->where('autoridades.fk_iddocentes', $id)->where('cargos.cargo', '<>', 'Suspendido')->where('autoridades.estado', '1')->first();

        $cargos = cargo::where('cargo', '<>', 'Suspendido')->get();

        $allcargos = autoridad::join('cargos', 'autoridades.fk_idcargos', '=', 'cargos.idcargos')
            ->select('cargos.cargo', 'autoridades.fech_ini', 'autoridades.fech_fin', 'autoridades.estado')
            ->where('autoridades.fk_iddocentes', $id)->orderBy('idAutoridades', 'desc')->get();

        $suspendido = autoridad::join('cargos', 'autoridades.fk_idcargos', '=', 'cargos.idcargos')
            ->where('autoridades.fk_iddocentes', $id)->where('cargos.cargo', 'Suspendido')->where('autoridades.estado', '1')->count();




        return view('departamento.DocentesSemanaEdit', compact('DetSemanas', 'Persona', 'Semanas', 'msg', 'cargoDocente', 'cargos', 'allcargos', 'suspendido'));
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
        $correo = DB::table('personas')->where('correo', $request->correo)->where('idPersonas', '<>', $request->idper)->count();
        if ($correo == 0) {
            $respuesta = DB::select('call p_crear_docente(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [$request->ev, $request->dni, $request->nombre, $request->appat, $request->apmat, $request->fnac, $request->cel, $request->clv, $request->idcnd, $request->idcat, $request->iddedi, $request->iddep, $request->idper, bcrypt($request->dni), $request->idusu, $request->correo, '1']);
        } else {
            $respuesta = '1';
        }
        return $respuesta;
    }
    public function updateSemana(Request $request, $id)
    {
        //$user->roles()->sync($request->roles);

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

    public function updateCargo(Request $request, $id)
    {

        if ($request->id != 0) {
            if (DB::table('autoridades')->where('fk_idDocentes', $id)->where('fk_idCargos', $request->id)->where('estado', 1)->exists()) {

                autoridad::where('fk_idDocentes', $id)->where('estado', 1)->update(array(
                    'fech_fin'  => $request->fin
                ));
            } else {
                autoridad::create([
                    'fk_idDocentes' => $id,
                    'fk_idCargos' => $request->id,
                    'fech_ini'  => $request->inicio,
                    'fech_fin'  => $request->fin,
                    'estado'    => '1',
                    'borrado'   => '1'
                ]);
            }
        }

        $Persona = Docente::join('personas', 'docentes.fk_idpersonas', '=', 'personas.idpersonas')
            ->select('personas.nombres', 'personas.apellPat', 'personas.apellMat')
            ->where('idDocentes', $id)->first();

        return view('departamento.docentes')->with('info', 'Se modifico el cargo al Docente: ' . $Persona->apellPat . ' ' . $Persona->apellMat . ' ' . $Persona->nombres);
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
        $respuesta = DB::select('call p_crear_docente(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)', [$request->ev, $request->dni, "1", "1", "1", "2000-10-10", "1", "1", "1", "1", "1", "1", $request->idper, "1", $request->idusu, "1", '1']);
        return $respuesta;
    }

    public function suspenderDocente($id)
    {

        $Persona = Docente::join('personas', 'docentes.fk_idpersonas', '=', 'personas.idpersonas')
            ->select('idDocentes', DB::raw('concat_ws(" " ,personas.nombres,personas.apellPat,personas.apellMat) as nombres'), 'personas.DNI',DB::raw('date_add(curdate(),interval 1 day) as dia'))->where('idDocentes', $id)->first();

        $allsupenciones = autoridad::join('cargos', 'autoridades.fk_idcargos', '=', 'cargos.idcargos')
            ->select('autoridades.fech_ini', 'autoridades.fech_fin', 'autoridades.estado')
            ->where('autoridades.fk_iddocentes', $id)->where('cargos.cargo', 'Suspendido')->orderBy('idAutoridades', 'desc')->get();

        return view('departamento.suspencionDocente', compact('allsupenciones', 'Persona'));
    }
    public function generarSuspencion(Request $request, $id)
    {
        $idsuspencion = DB::table('cargos')->where('cargo', 'Suspendido')->value('idCargos');
        autoridad::create([
            'fk_idDocentes' => $id,
            'fk_idCargos' => $idsuspencion,
            'fech_ini'  => $request->inicio,
            'fech_fin'  => $request->fin,
            'estado'    => '1',
            'borrado'   => '1'
        ]);
        return redirect()->route('docentes.suspenderDocente', $id);
    }
}
