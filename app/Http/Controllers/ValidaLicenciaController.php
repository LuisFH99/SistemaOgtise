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
use App\Models\FirmaHasSolicitud;
use App\Models\Adjunto;
use App\Models\Firma;
use App\Models\Administrativo;

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
    public function imprimir(Request $request){
        //$user=auth()->user();
        $idso=$request->idSol;
        $solicitudes=Solicitud:://DB::table('solicitudes')
            join('estadosolicitudes', 'solicitudes.fk_idEstadoSolicitudes', '=', 'estadosolicitudes.idEstadoSolicitudes')
            ->join('motivosolicitudes', 'solicitudes.fk_idMotivoSolicitudes', '=', 'motivosolicitudes.idMotivoSolicitudes')
            ->join('docentes', 'solicitudes.fk_idDocentes', '=', 'docentes.idDocentes')
            ->join('personas', 'docentes.fk_idPersonas', '=', 'personas.idPersonas')
            ->join('depacademicos', 'docentes.fk_idDepAcademicos', '=', 'depacademicos.idDepAcademicos')
            ->join('facultades', 'depacademicos.fk_idFacultades', '=', 'facultades.id_Facultades')
            ->select('solicitudes.*','estadosolicitudes.estadoSol',
                    'motivosolicitudes.motivo','personas.*','depacademicos.nomdep','facultades.nomFac')
            ->where('idSolicitudes',$idso)->latest('idSolicitudes')->first();
        $Firmas=FirmaHasSolicitud::join('personas', 'firmahassolicitudes.fk_idPersonas', '=', 'personas.idPersonas')
            ->join('solicitudes', 'firmahassolicitudes.fk_idsolicitudes', '=', 'solicitudes.idSolicitudes')
            ->join('firmas', 'firmahassolicitudes.fk_idFirmas', '=', 'firmas.idFirmas')
            ->join('tipfirmas', 'firmas.fk_idTipFirmas', '=', 'tipfirmas.idTipFirmas')
            ->where('fk_idSolicitudes',$solicitudes->idSolicitudes)->orderBy('idFirmaHasSolicitudes')->get();
        $DocsAd=Adjunto::where('fk_idSolicitudes',$solicitudes->idSolicitudes)->get();
        $Motivos=MotivoSolicitud::all();
        $aux=0;
        $url='storage/Archivos/'.$solicitudes->fech_solicitud.'_'.$solicitudes->codigo.'.pdf';
        //$Sol=Solicitud::where('idSolicitudes', $solicitudes->idSolicitudes)->update(array('url_doc' => $url));
        $pdf = PDF :: loadView ( 'docentes.PDFs.reporteSolicitud' , compact('solicitudes','Motivos','DocsAd','Firmas','aux'));
        /*return  */$pdf->save($url)/*->stream()*/;
        return /*view('docentes.licencias',compact('user','Motivos'))*/'/'.$url;
    }
    public function datos(Request $request){
        $user=auth()->user();
        $Roles=$user->getRoleNames();
        $Role=0;$Valor=0;
        foreach ($Roles as $value) {
            switch($value) {
                case('URyC'):
                    $Role=1;
                    break;
                case('Director RRHH'):
                    $Role=1;
                    break;
                default:
                    $Role=0;
            }
        }
        if($Role==0){
            $iddoc=Docente::join('personas', 'docentes.fk_idPersonas', '=', 'personas.idPersonas')
            ->select('idDocentes')->where('correo',$user->email)->first();
            $Valor=Docente::where('clave','=',''.$request->dt.'')->where('idDocentes',$iddoc->idDocentes)->count();
        }
        if($Role==1){
            $idper=Persona::select('idPersonas')->where('correo',$user->email)->first();
            $Valor=Administrativo::where('clave','=',''.$request->dt.'')->where('fk_idPersonas',$idper->idPersonas)->count();
        }
        return $Valor;
    }
    public function store(Request $request)
    {
        $user=auth()->user();
        //$dto=$request->all();
        $toke=bin2hex(random_bytes(8));
        $ips=request()->ip();
        
        $idEst=EstadoSolicitud::where('estadoSol',$request->dt1)->first();
        $Sol=Solicitud::where('idSolicitudes', $request->idSol)->update(array('fk_idEstadoSolicitudes' => $idEst->idEstadoSolicitudes));
        $Persona=Persona::select('idPersonas',DB::raw('now() as dia'))->where('correo',$user->email)->first();
        $fecha=$Persona->dia;//date('Y-m-d H:i:s'); 
        Firma::create([
            'firma'=>$ips, 
            'token'=>$toke, 
            'estado'=>1, 
            'fk_idTipFirmas'=>$request->idTf,
        ]);
        $ultFirma=Firma::latest('idFirmas')->first();
        FirmaHasSolicitud::create([
            'fechaFirma'        =>$fecha,
            'fk_idFirmas'       =>$ultFirma->idFirmas,
            'fk_idSolicitudes'  =>$request->idSol, 
            'fk_idPersonas'     =>$Persona->idPersonas,
        ]);
        $solicitudes=Solicitud:://DB::table('solicitudes')
            join('estadosolicitudes', 'solicitudes.fk_idEstadoSolicitudes', '=', 'estadosolicitudes.idEstadoSolicitudes')
            ->join('motivosolicitudes', 'solicitudes.fk_idMotivoSolicitudes', '=', 'motivosolicitudes.idMotivoSolicitudes')
            ->join('docentes', 'solicitudes.fk_idDocentes', '=', 'docentes.idDocentes')
            ->join('personas', 'docentes.fk_idPersonas', '=', 'personas.idPersonas')
            ->join('depacademicos', 'docentes.fk_idDepAcademicos', '=', 'depacademicos.idDepAcademicos')
            ->join('facultades', 'depacademicos.fk_idFacultades', '=', 'facultades.id_Facultades')
            ->select('solicitudes.*','estadosolicitudes.estadoSol',
                    'motivosolicitudes.motivo','personas.*','depacademicos.nomdep','facultades.nomFac')
            ->where('idSolicitudes',$request->idSol)->first();
        $Firmas=FirmaHasSolicitud::join('personas', 'firmahassolicitudes.fk_idPersonas', '=', 'personas.idPersonas')
            ->join('solicitudes', 'firmahassolicitudes.fk_idsolicitudes', '=', 'solicitudes.idSolicitudes')
            ->join('firmas', 'firmahassolicitudes.fk_idFirmas', '=', 'firmas.idFirmas')
            ->join('tipfirmas', 'firmas.fk_idTipFirmas', '=', 'tipfirmas.idTipFirmas')
            ->where('fk_idSolicitudes',$solicitudes->idSolicitudes)->orderBy('idFirmaHasSolicitudes')->get();
        $DocsAd=Adjunto::where('fk_idSolicitudes',$request->idSol)->get();
        $Motivos=MotivoSolicitud::all();
        $aux=0;
        $url='storage/Archivos/'.$solicitudes->fech_solicitud.'_'.$solicitudes->codigo.'.pdf';
        
        $pdf = PDF :: loadView ( 'docentes.PDFs.reporteSolicitud' , compact('solicitudes','Motivos','DocsAd','Firmas','aux'));
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
