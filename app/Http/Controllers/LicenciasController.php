<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Persona;
use App\Models\Docente;
use App\Models\Solicitud;
use App\Models\MotivoSolicitud;
use App\Models\Adjunto;
use App\Models\Firma;

use App\Mail\ContactanosMailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use PDF;
class LicenciasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function imprimir(){
        $user=auth()->user();
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
            ->where('personas.correo',$user->email)->latest('idSolicitudes')->first();
        $DocsAd=Adjunto::where('fk_idSolicitudes',$solicitudes->idSolicitudes)->get();
        $aux=0;
        $url='storage/Archivos/'.$solicitudes->fech_solicitud.'_'.$solicitudes->codigo.'.pdf';
        //$Sol=Solicitud::where('idSolicitudes', $solicitudes->idSolicitudes)->update(array('url_doc' => $url));
        $pdf = PDF :: loadView ( 'docentes.PDFs.reporteSolicitud' , compact('solicitudes','DocsAd','aux'));
        return  $pdf->save($url)/*->stream()*/;
    }
    public function index()
    {
        $user=auth()->user();
        $Motivos=MotivoSolicitud::all();
        return view('docentes.licencias',compact('user','Motivos'));
    }

    public function create()
    {
        return view('licencias.create');
    }

    public function store(Request $request)
    {
        $codSoli=bin2hex(random_bytes(4));
        $toke=bin2hex(random_bytes(8));
        $ips=request()->ip();
        $fecha=date('Y-m-d'); 
        $hora=date("H:i:s"); 
        $user=auth()->user();
        $url="xdxd.pdf";
        $Motivos=MotivoSolicitud::all();
        $Docente=Docente::join('personas', 'docentes.fk_idPersonas', '=', 'personas.idPersonas')
                         ->where('correo',$user->email)->first();
        $nombreDoc=''.$Docente->nombres.' '.$Docente->apellPat.' '.$Docente->apellMat;
        
        $arrayInfo=['codSoli'=>$codSoli,'fecha'=>$fecha,'hora'=>$hora,'nombreDoc'=>$nombreDoc];
        $correo=new ContactanosMailable($arrayInfo);
        Mail::to($user->email)->send($correo);
        Firma::create([
            'firma'=>$ips, 
            'token'=>$toke, 
            'estado'=>1, 
            'fk_idTipFirmas'=>$request->idTf,
        ]);
        $ultFirma=Firma::latest('idFirmas')->first();
        $url='storage/Archivos/'.$fecha.'_'.$codSoli.'.pdf';
        Solicitud::create([
            'fech_solicitud'    =>$fecha,
            'hor_solicitud'     =>$hora,
            'fech_inicio'       =>$request->Fdesde,
            'fech_fin'          =>$request->Fhasta,
            'fech_retorno'      =>$request->reinc,
            'justificacion'     =>$request->Justificacion,
            'num_dias'          =>$request->Ndias,
            'reemplazo'         =>'',
            'firm_reemplazo'    =>'',
            'url_doc'           =>'/'.$url,
            'observacion'       =>'',
            'codigo'            =>$codSoli,
            'estado'            =>1,
            'fk_idFirmas'       =>$ultFirma->idFirmas,
            'fk_idMotivoSolicitudes'=>$request->Motivo,
            'fk_idEstadoSolicitudes'=>1,
            'fk_idDocentes'     =>$Docente->idDocentes
        ]);
        // $solicitudes=Solicitud:://DB::table('solicitudes')
        //     join('estadosolicitudes', 'solicitudes.fk_idEstadoSolicitudes', '=', 'estadosolicitudes.idEstadoSolicitudes')
        //     ->join('firmas', 'solicitudes.fk_idFirmas', '=', 'firmas.idFirmas')
        //     ->join('tipfirmas', 'firmas.fk_idTipFirmas', '=', 'tipfirmas.idTipFirmas')
        //     ->join('motivosolicitudes', 'solicitudes.fk_idMotivoSolicitudes', '=', 'motivosolicitudes.idMotivoSolicitudes')
        //     ->join('docentes', 'solicitudes.fk_idDocentes', '=', 'docentes.idDocentes')
        //     ->join('personas', 'docentes.fk_idPersonas', '=', 'personas.idPersonas')
        //     ->join('depacademicos', 'docentes.fk_idDepAcademicos', '=', 'depacademicos.idDepAcademicos')
        //     ->join('facultades', 'depacademicos.fk_idFacultades', '=', 'facultades.id_Facultades')
        //     ->select('solicitudes.*','estadosolicitudes.estadoSol','firmas.token','firmas.firma','tipfirmas.tipo',
        //             'motivosolicitudes.motivo','personas.*','depacademicos.nomdep','facultades.nomFac')
        //     ->where('personas.correo',$user->email)->latest('idSolicitudes')->first();
        // $DocsAd=Adjunto::where('fk_idSolicitudes',$solicitudes->idSolicitudes)->get();
        // $aux=0;
        // //$Sol=Solicitud::where('idSolicitudes', $solicitudes->idSolicitudes)->update(array('url_doc' => $url));
        // $pdf = PDF :: loadView ('docentes.PDFs.reporteSolicitud' , compact('solicitudes','DocsAd','aux'));
        // $pdf->save($url);
        return $arrayInfo;
    }
    public function dato(Request $request){
        $Valor=Docente::where('clave','=',''.$request->dt.'')->count();
        return $Valor;
    }
    public function file(Request $request)
    {
        $user=auth()->user();
        // $docente = DB::table('docentes')
        //     ->join('personas', 'docentes.fk_idPersonas', '=', 'personas.idPersonas')
        //     ->where('correo',$user->email)->first();
        // $solicitud=DB::table('solicitudes')->where('fk_idDocentes',$docente->idDocentes)
        //     ->orderBy('idSolicitudes', 'desc')->limit(1)->get();
        $idSol=Docente::join('personas', 'docentes.fk_idPersonas', '=', 'personas.idPersonas')
            ->join('solicitudes', 'docentes.idDocentes', '=', 'solicitudes.fk_idDocentes')
            ->select('idSolicitudes')->where('correo',$user->email)
            ->latest('idSolicitudes')->first();
        $Archivos= $request->file('file')->store('public/Archivos');
        $url=Storage::url($Archivos);
        // $Adjuntos=new Adjunto;
        // $Adjuntos->docs= $url;
        // $Adjuntos->estado= 1;
        // $Adjuntos->fk_idSolicitudes=$solicitud;
        // $Adjuntos->save();
        Adjunto::create([
            'docs'=>$url,
            'estado'=>1,
            'fk_idSolicitudes'=>$idSol->idSolicitudes
        ]);
        // $ultArchivo=Adjunto::orderBy('id', 'desc')->first();
        return $url;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($licencia)
    {
        return view('docentes.licencias');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($licencia)
    {
        return view('Licencias.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $licencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($licencia)
    {
        //
    }
    
}
