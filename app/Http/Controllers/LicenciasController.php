<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Persona;
use App\Models\Docente;
use App\Models\Solicitud;
use App\Models\MotivoSolicitud;
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
            // _token: $('input[name="_token"]').val(),
            // Motivo: idMot,
            // Justificacion: txtareajus,
            // Fdesde: desde,
            // Fhasta: hasta,
            // Ndias: dias,
            // Firma: txtCodigoFirma,
            // 'fech_solicitud',
            // 'hor_solicitud',
            // 'fech_inicio',
            // 'fech_fin', 
            // 'justificacion',
            // 'num_dias',
            // 'reemplazo',
            // 'firm_reemplazo',
            // 'url_doc',
            // 'observacion',
            // 'estado',
            // 'fk_idFirmas',
            // 'fk_idMotivoSolicitudes',
            // 'fk_idEstadoSolicitudes', 
            // 'fk_idDocentes'
        $Datos=$request->all();
        $codSoli=bin2hex(random_bytes(4));
        $fecha=date('Y-m-d'); 
        $hora=date("H:i:s"); 
        $user=auth()->user();
        $Motivos=MotivoSolicitud::all();
        $correo=new ContactanosMailable($request->all());
        Mail::to($user->email)->send($correo);
        
        
        return redirect()->route('docentes.licencias',compact('user','Motivos'))->with('info','Mensaje Enviado');
    }
    public function file(Request $request)
    {
        $Archivos= $request->file('file')->store('public/Archivos');
        $this->url=Storage::url($Archivos);
        // File::create([
        //     'url' => $url
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
