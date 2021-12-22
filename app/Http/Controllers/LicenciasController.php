<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Persona;
use App\Models\Docente;
use App\Models\Solicitud;
use App\Models\MotivoSolicitud;
use App\Models\Adjunto;
use App\Models\DetAdjunto;
use App\Models\Firma;

use App\Mail\ContactanosMailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class LicenciasController extends Controller
{
    public $url='';
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
        $Motivos=MotivoSolicitud::all();
        return view('docentes.licencias',compact('user','Motivos'));
    }
    // public function ip()
    // {
    //     //return $this->getClientIp(); //original method
    //     return $this->getIp(); // the above method
    // }
    // public function getIp(){
    //     foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
    //         if (array_key_exists($key, $_SERVER) === true){
    //             foreach (explode(',', $_SERVER[$key]) as $ip){
    //                 $ip = trim($ip); // just to be safe
    //                 if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
    //                     return $ip;
    //                 }
    //             }
    //         }
    //     }
    // }
     /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('licencias.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Datos=$request->all();
        $codSoli=bin2hex(random_bytes(4));
        $ips=request()->ip();
        $fecha=date('Y-m-d'); 
        $hora=date("H:i:s"); 
        $user=auth()->user();
        $Motivos=MotivoSolicitud::all();
        $Docente=Docente::join('personas', 'docentes.fk_idPersonas', '=', 'personas.idPersonas')
                         ->where('correo',$user->email)->first();
        $nombreDoc=''.$Docente->nombres.' '.$Docente->apellPat.' '.$Docente->apellMat;
        $arrayInfo=['codSoli'=>$codSoli,'fecha'=>$fecha,'hora'=>$hora,'nombreDoc'=>$nombreDoc];
        $correo=new ContactanosMailable($arrayInfo);
        Mail::to('ds0001cp@gmail.com')->send($correo);
        // Firma::create([
        //     'firma'=>$ips, 
        //     'token'=>$Datos->_token, 
        //     'estado'=>1, 
        //     'fk_idTipFirmas'=>1,
        // ]);
        //latest()->first();->limit(1);
        // $ultFirma=Firma::orderBy('id', 'desc')->first();
        // Solicitud::create([
        //     'fech_solicitud'=>$fecha,
        //     'hor_solicitud'=>$hora,
        //     'fech_inicio'=>$Datos->Fdesde,
        //     'fech_fin'=>$Datos->Fhasta, 
        //     'justificacion'=>$Datos->Justificacion,
        //     'num_dias'=>$Datos->Ndias,
        //     'reemplazo'=>'',
        //     'firm_reemplazo'=>'',
        //     'url_doc'=>$url,
        //     'observacion'=>'',
        //     'codigo'=>$codSoli,
        //     'estado'=>1,
        //     'fk_idFirmas'=>$ultFirma->idFirmas,
        //     'fk_idMotivoSolicitudes'=>$Datos->Motivo,
        //     'fk_idEstadoSolicitudes'=>1, 
        //     'fk_idDocentes'=>$Docente->idDocentes,
        // ]);
        return $arrayInfo;
    }
    public function file(Request $request)
    {
        $user=auth()->user();
        $Archivos= $request->file('file')->store('public/Archivos');
        $this->url=Storage::url($Archivos);
        Adjunto::create([
            'docs'=> $url,
            'estado'=> 1
        ]);
        
        // $ultArchivo=Adjunto::orderBy('id', 'desc')->first();
        // DetAdjunto::create([
        //     'estado'=> 1,
        //     //'fk_idAdjuntos'=>,
        //     //'fk_idSolicitudes'=>,
        // ]);
        return $this->url;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($licencia)
    {
        return view('Licencias.show');
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
