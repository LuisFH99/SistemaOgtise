<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

use App\Models\User;
use App\Models\Persona;
use App\Models\Docente;
use App\Models\Solicitud;
use App\Models\MotivoSolicitud;
use App\Models\FirmaHasSolicitud;
use App\Models\Adjunto;
use App\Models\Firma;

use App\Mail\ContactanosMailable;

use PDF;

class LicenciasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
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
    public function index()
    {
        $user=auth()->user();
        $Motivos=MotivoSolicitud::all();
        $fecha=Persona::select(DB::raw('curdate() as fech'))->where('correo',$user->email)->first();
        $fechaMin=date('Y-m-d',strtotime($fecha->fech.'+ 1 days'));
        $fechaExc=date('Y-m-d',strtotime($fecha->fech.'- 10 days'));

        return view('docentes.licencias',compact('user','Motivos','fechaMin','fechaExc'));
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
        // $fecha=date('Y-m-d'); 
        // $hora=date("H:i:s");
        $user=auth()->user();
        $url="";
        $Motivos=MotivoSolicitud::all();
        $Docente=Docente::join('personas', 'docentes.fk_idPersonas', '=', 'personas.idPersonas')
                        ->select('idDocentes','idPersonas',DB::raw('curdate() as dia'), DB::raw('curtime() as hora'))
                        ->where('correo',$user->email)->first();
        
        Firma::create([
            'firma'=>$ips, 
            'token'=>$toke, 
            'estado'=>1, 
            'fk_idTipFirmas'=>$request->idTf,
        ]);
        $ultFirma=Firma::latest('idFirmas')->first();
        $url='storage/Archivos/'.$Docente->dia.'_'.$Docente->hora.'.pdf';
        Solicitud::create([
            'fech_solicitud'    =>$Docente->dia,
            'hor_solicitud'     =>$Docente->hora,
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
            //'fk_idFirmas'       =>$ultFirma->idFirmas,
            'fk_idMotivoSolicitudes'=>$request->Motivo,
            'fk_idEstadoSolicitudes'=>1,
            'fk_idDocentes'     =>$Docente->idDocentes
        ]);
        $idSol=Docente::join('personas', 'docentes.fk_idPersonas', '=', 'personas.idPersonas')
            ->join('solicitudes', 'docentes.idDocentes', '=', 'solicitudes.fk_idDocentes')
            ->select('idSolicitudes')->where('correo',$user->email)
            ->latest('idSolicitudes')->first();
        FirmaHasSolicitud::create([
            'fechaFirma'        =>$Docente->dia.' '.$Docente->hora,
            'fk_idFirmas'       =>$ultFirma->idFirmas,
            'fk_idSolicitudes'  =>$idSol->idSolicitudes, 
            'fk_idPersonas'     =>$Docente->idPersonas,
        ]);
        $nombreDoc=''.$Docente->nombres.' '.$Docente->apellPat.' '.$Docente->apellMat;
        $arrayInfo=['codSoli'=>$codSoli,'fecha'=>$Docente->dia,'hora'=>$Docente->hora,'nombreDoc'=>$nombreDoc,'idSoli'=>$idSol->idSolicitudes];
        $correo=new ContactanosMailable($arrayInfo);
        Mail::to($user->email)->send($correo);
        return $arrayInfo;
    }
    public function dato(Request $request){
        $user=auth()->user();
        $iddoc=Docente::join('personas', 'docentes.fk_idPersonas', '=', 'personas.idPersonas')
        ->select('idDocentes')->where('correo',$user->email)->first();
        $Valor=Docente::where('clave','=',''.$request->dt.'')->where('idDocentes',$iddoc->idDocentes)->count();
        return $Valor;
    }
    public function file(Request $request)
    {
        
        $user=auth()->user();
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
    public function eliminar(Request $request)
    {
        $Sol=Solicitud::where('idSolicitudes', $request->idSol)
            ->where('fk_idEstadoSolicitudes', 1)->update(array('estado' => 0));
        return $Sol;
    }
    
}
