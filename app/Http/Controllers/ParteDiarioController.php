<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Asistencia;
use App\Models\Facultad;
use App\Models\FechAsistencia;
use Dompdf\Dompdf;
use Dompdf\Options;
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
        $docentes = DB::table('docentes')
            ->join('personas', 'docentes.fk_idpersonas', '=', 'personas.idpersonas')
            ->join('depacademicos', 'docentes.fk_idDepAcademicos', '=', 'depacademicos.iddepacademicos')
            ->join('facultades', 'depacademicos.fk_idfacultades', '=', 'facultades.id_facultades')
            ->join('condiciones', 'docentes.fk_idcondiciones', '=', 'condiciones.idcondiciones')
            ->join('categorias', 'docentes.fk_idcategorias', '=', 'categorias.idcategorias')
            ->join('dedicaciones', 'docentes.fk_iddedicaciones', '=', 'dedicaciones.iddedicaciones')
            ->join('users', 'personas.correo', '=', 'users.email')
            ->select('personas.idpersonas', 'personas.dni', 'docentes.iddocentes', DB::raw('concat_ws(" ",personas.apellpat,personas.apellmat,personas.nombres) as nombres'), 'personas.correo', 'personas.telefono', 'facultades.nomfac', 'depacademicos.nomdep', 'condiciones.nomcondi', 'categorias.nomcat', 'dedicaciones.nomdedi', 'users.id', 'docentes.iddocentes')->where('docentes.estado', 1)->where('personas.estado', 1)->get();
        return view('URC.partediario', compact('docentes'));
    }

    public function allAsistencias(Request $request)
    {
        $allregistros = Asistencia::join('fechasistencias', 'asistencias.fk_idfechasistencias', '=', 'fechasistencias.idfechasistencias')
            ->select('asistencias.fk_idestadoAsistencias as estado', DB::raw("date_format(fechasistencias.fecha,'%d') as dia "))->where('asistencias.fk_iddocentes', $request->idd)->where(DB::raw('month(fechasistencias.fecha)'), $request->mes)->where(DB::raw('year(fechasistencias.fecha)'), $request->year)->get();

        return $allregistros;
    }

    public function justificarAsistencia(Request $request)
    {
        
        $fecha=DB::table('fechasistencias')->where('fecha','=',$request->fecha)->first();
        $justificacion=DB::table('asistencias')->where('fk_iddocentes',$request->iddoc)->where('fk_idfechasistencias',$fecha->idFechAsistencias)
        ->update(array('fk_idEstadoAsistencias' => 3));
        return $justificacion;
    }

    public function reportegeneral($fecha)
    {

        $datos = DB::select('call P_InformeGeneral(?)', [$fecha]);
        $pdf = PDF::loadView('URC.Reportes.reportegeneral', compact('datos', 'fecha'));
        $pdf->setPaper("A4", "portrait");
        return  $pdf->stream();
    }
    public function reportegeneralfaltas($fecha)
    {

        $datos = DB::select('call P_InformeGeneralFaltas(?)', [$fecha]);
        $pdf = PDF::loadView('URC.Reportes.reportegeneralfaltas', compact('datos', 'fecha'));
        $pdf->setPaper("A4", "portrait");
        return  $pdf->stream();
    }

    public function reportedocente($id, $mes, $aa)
    {

        $datos = Asistencia::join('asistenciaentradas', 'asistencias.fk_idasistenciaentradas', '=', 'asistenciaentradas.idasistenciaentradas')
            ->join('asistenciasalidas', 'asistencias.fk_idasistenciasalidas', '=', 'asistenciasalidas.idasistenciasalidas')
            ->join('firmas as m', 'asistenciaentradas.fk_idfirmas', '=', 'm.idfirmas')
            ->join('firmas as t', 'asistenciasalidas.fk_idfirmas', '=', 't.idfirmas')
            ->join('fechasistencias', 'asistencias.fk_idfechasistencias', '=', 'fechasistencias.idfechasistencias')
            ->select(DB::raw("concat_ws(', ', CONCAT(ELT(WEEKDAY(fechasistencias.fecha) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo')),DATE_FORMAT(fechasistencias.fecha,'%d/%m/%Y')) as Dia"), 'asistencias.fk_idestadoAsistencias', 'asistenciaentradas.hor_entrada', 'asistenciaentradas.url_foto as foto', 'm.firma as fentrada', 'm.token as tkentrada', 'asistenciasalidas.hor_salida', 't.firma as fsalida', 't.token as tksalida')->where('asistencias.fk_iddocentes', '=', $id)->where(DB::raw('month(fechasistencias.fecha)'), '=', $mes)->where(DB::raw('year(fechasistencias.fecha)'), '=', $aa)->get();

        $docentes = DB::table('docentes')
            ->join('personas', 'docentes.fk_idpersonas', '=', 'personas.idpersonas')
            ->join('depacademicos', 'docentes.fk_idDepAcademicos', '=', 'depacademicos.iddepacademicos')
            ->join('facultades', 'depacademicos.fk_idfacultades', '=', 'facultades.id_facultades')
            ->join('condiciones', 'docentes.fk_idcondiciones', '=', 'condiciones.idcondiciones')
            ->join('categorias', 'docentes.fk_idcategorias', '=', 'categorias.idcategorias')
            ->join('dedicaciones', 'docentes.fk_iddedicaciones', '=', 'dedicaciones.iddedicaciones')
            ->select('personas.idpersonas', 'personas.dni', 'docentes.iddocentes', DB::raw('concat_ws(" ",personas.apellpat,personas.apellmat,personas.nombres) as nombres'), 'personas.correo', 'personas.telefono', 'facultades.nomfac', 'depacademicos.nomdep', 'condiciones.nomcondi', 'categorias.nomcat', 'dedicaciones.nomdedi', 'docentes.iddocentes')->where('docentes.iddocentes', $id)->first();

        $pdf = PDF::loadView('URC.Reportes.reportedocentes', compact('id', 'mes', 'aa', 'datos', 'docentes'));
        $pdf->setPaper("A4", "portrait");
        return $pdf->stream();
        // return $datos;
    }
}
