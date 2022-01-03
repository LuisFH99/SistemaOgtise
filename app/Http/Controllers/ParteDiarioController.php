<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Asistencia;
use App\Models\Facultad;
use PDF;


class ParteDiarioController extends Controller
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
        return view('URC.partediario');
    }

    public function reportegeneral()
    {

        /*$datos=Asistencia::join('docentes as a','asistencias.fk_iddocentes','=','a.iddocentes')
       ->join('personas as p','a.fk_idpersonas','=','p.idpersonas')
       ->join('depacademicos as d','a.fk_idDepAcademicos','=','d.iddepacademicos')
       ->join('facultades as f','d.fk_idfacultades','=','f.id_facultades')
       ->join('condiciones as c','a.fk_idcondiciones','=','c.idcondiciones')
       ->join('categorias as t','a.fk_idcategorias','=','t.idcategorias')
       ->join('dedicaciones as i','a.fk_iddedicaciones','=','i.iddedicaciones')
       ->join('fechasistencias as h','asistencias.fk_idfechasistencias','=','h.idfechasistencias')
       ->join('asistenciaentradas as n','asistencias.fk_idasistenciaentradas','=','n.idasistenciaentradas')
       ->join('asistenciasalidas as s','asistencias.fk_idasistenciasalidas','=','s.idasistenciasalidas')
       ->join('firmas as b','n.fk_idfirmas','=','b.idfirmas')
       ->join('firmas as g','s.fk_idfirmas','=','g.idfirmas')

       ->select('f.nomfac', 'd.nomdep', DB::raw("concat_ws(' ', p.apellpat,p.apellmat,p.nombres) as nombres"), 'c.nomcondi','t.nomcat','i.nomdedi','b.firma as fentrada','n.hor_entrada','b.token as tkentrada', 'g.firma as fsalida','s.hor_salida', 'g.token as tksalida')->where('a.estado',1)->where('p.estado',1)->where('h.fecha','2021-12-28')->get();*/

        $datos = DB::select('call P_InformeGeneral(?)', ['2021-12-27']);
        //return view('URC.Reportes.reportegeneral',compact('datos'));



        $pdf = PDF::loadView('URC.Reportes.reportegeneral', compact('datos'));
        $pdf->setPaper("A4", "portrait");
        return  $pdf->stream();
    }
}
