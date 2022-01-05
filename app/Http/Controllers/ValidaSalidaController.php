<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Persona;
use App\Models\Docente;
use App\Models\Asistencia;
use App\Models\AsistenciaSalida;
use App\Models\Firma;
use App\Models\TipFirma;
use App\Models\Evidencia;
class ValidaSalidaController extends Controller
{
   /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user=auth()->user();
        $fecha=date('Y-m-d');
        return view('departamento.ValidaSalida',compact('user','fecha'));
    }
    public function create()
    {
        //return view('licencias.create');
    }

    public function store(Request $request)
    {
        $user=auth()->user();
        $dt=$request->idsal.','.$request->Justif;
        $Salida=Asistencia::where('fk_idAsistenciaSalidas', $request->idsal)->update(array('observacion' =>$request->Justif));
        return $dt;
    }
    public function dato(Request $request){
        $Valor=Docente::where('clave','=',''.$request->dt.'')->count();
        return $Valor;
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($ValSal)
    {
        //return view('docentes.licencias');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($ValSal)
    {
        //return view('Licencias.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $ValSal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ValSal)
    {
        //
    }
}
