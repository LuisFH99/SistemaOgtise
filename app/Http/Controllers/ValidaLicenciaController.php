<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use App\Models\Persona;
use App\Models\Docente;
use App\Models\Solicitud;
use App\Models\MotivoSolicitud;
use App\Models\EstadoSolicitud;
use App\Models\Adjunto;
use App\Models\Firma;

use PDF;

class ValidaLicenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function index()
    {
        $user=auth()->user();
        return view('departamento.ValidaLicencia',compact('user'));
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
    public function datos(Request $request){
        $Valor=Docente::where('clave','=',''.$request->dt.'')->count();
        return $Valor;
    }
    public function store(Request $request)
    {
        $user=auth()->user();
        //$dto=$request->all();

        $idEst=EstadoSolicitud::where('estadoSol',$request->dt)->first();
        $Sol=Solicitud::where('idSolicitudes', $request->idSol)->update(array('fk_idEstadoSolicitudes' => $idEst->idEstadoSolicitudes));
        $solicitudes=Solicitud:://DB::table('solicitudes')
            join('estadosolicitudes', 'solicitudes.fk_idEstadoSolicitudes', '=', 'estadosolicitudes.idEstadoSolicitudes')
            ->join('firmas', 'solicitudes.fk_idFirmas', '=', 'firmas.idFirmas')
            ->join('tipfirmas', 'firmas.fk_idTipFirmas', '=', 'tipfirmas.idTipFirmas')
            ->join('motivosolicitudes', 'solicitudes.fk_idMotivoSolicitudes', '=', 'motivosolicitudes.idMotivoSolicitudes')
            ->join('docentes', 'solicitudes.fk_idDocentes', '=', 'docentes.idDocentes')
            ->join('personas', 'docentes.fk_idPersonas', '=', 'personas.idPersonas')
            ->join('depacademicos', 'docentes.fk_idDepAcademicos', '=', 'depacademicos.idDepAcademicos')
            ->join('facultades', 'depacademicos.fk_idFacultades', '=', 'facultades.id_Facultades')
            ->select('solicitudes.*','estadosolicitudes.estadoSol','firmas.token','firmas.firma','tipfirmas.tipo',
                    'motivosolicitudes.motivo','personas.*','depacademicos.nomdep','facultades.nomFac')
            ->where('idSolicitudes',$request->idSol)->first();
        $DocsAd=Adjunto::where('fk_idSolicitudes',$request->idSol)->get();
        $aux=0;
        $url='storage/Archivos/'.$solicitudes->fech_solicitud.'_'.$solicitudes->codigo.'.pdf';
        
        $pdf = PDF :: loadView ( 'docentes.PDFs.reporteSolicitud' , compact('solicitudes','DocsAd','aux'));
        /*return  */$pdf->save($url)/*->stream()*/;
        return /*view('docentes.licencias',compact('user','Motivos'))*/$url;
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
