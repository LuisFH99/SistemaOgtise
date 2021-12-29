<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Docente;
use App\Models\Asistencia;
use App\Models\Evidencia;
use Illuminate\Support\Facades\Storage;

use Carbon\Carbon;
use JeroenNoten\LaravelAdminLte\Components\Widget\Alert;

class EntradaController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    // , $fecha, $hora;

    private $fecha;
    private $hora;

    public function __construct()
    {
        $this->middleware('auth');
    }

    // public function DarValor($id,$f,$h){
    //     $this -> iddocente=$id;
    //     $this -> fecha=$f;
    //     $this -> hora=$h;
    // }
    // public function getiddocente(){
    //     return $this -> iddocente;
    // }
    // public function getfecha(){
    //     return $this -> fecha;
    // }
    // public function gethora(){
    //     return $this -> hora;
    // }

    public function getidDocente(){
        $Datos = Docente::join('personas', 'docentes.fk_idpersonas', '=', 'personas.idpersonas')
            ->select('docentes.idDocentes', DB::raw('curdate() as dia'), DB::raw('curtime() as hora'))->where('personas.correo', auth()->user()->email)->first();

        return $Datos->idDocentes;
    }

    public function index()
    {
        //$user = auth()->user();
        $Datos = Docente::join('personas', 'docentes.fk_idpersonas', '=', 'personas.idpersonas')
            ->select('docentes.idDocentes', DB::raw('curdate() as dia'), DB::raw('curtime() as hora'))->where('personas.correo', auth()->user()->email)->first();

        $registros = Asistencia::join('asistenciaentradas', 'asistencias.fk_idasistenciaentradas', '=', 'asistenciaentradas.idasistenciaentradas')
        ->join('asistenciasalidas', 'asistencias.fk_idasistenciasalidas', '=', 'asistenciasalidas.idasistenciasalidas')
        ->join('fechasistencias', 'asistencias.fk_idfechasistencias', '=', 'fechasistencias.idfechasistencias')
        ->select(DB::raw("concat_ws(', ', CONCAT(ELT(WEEKDAY(fechasistencias.fecha) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo')),DATE_FORMAT(fechasistencias.fecha,'%d/%m/%Y')) as Dia"),'asistenciaentradas.hor_entrada','asistenciasalidas.hor_salida','asistencias.observacion')->where('asistencias.fk_iddocentes',$this->getidDocente())->where('fechasistencias.dia','<>','Saturday')->where('fechasistencias.dia','<>','Sunday')->where('fechasistencias.dia','<>','Saturday')->where('fechasistencias.fecha','<>',DB::raw('curdate()'))->orderByRaw('fechasistencias.fecha desc')->limit(5)->get();


        $estado = Asistencia::join('fechasistencias', 'asistencias.fk_idfechasistencias', '=', 'fechasistencias.idfechasistencias')
            ->join('asistenciaentradas', 'asistencias.fk_idasistenciaentradas', '=', 'asistenciaentradas.idasistenciaentradas')
            ->join('asistenciasalidas', 'asistencias.fk_idasistenciasalidas', '=', 'asistenciasalidas.idasistenciasalidas')
            ->select('asistencias.fk_idestadoasistencias', 'asistenciaentradas.hor_entrada', 'asistenciasalidas.hor_salida')->where('asistencias.fk_iddocentes', $this->getidDocente())->where('fechasistencias.fecha', DB::raw('curdate()'))->first();

        

        $var = 2;

        return view('docentes.entrada', compact('var', 'Datos', 'estado','registros'));
    }

    


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allregistros(Request $request)
    {

        $allregistros= Asistencia::join('fechasistencias', 'asistencias.fk_idfechasistencias', '=', 'fechasistencias.idfechasistencias')
        ->select('asistencias.fk_idestadoAsistencias as estado', DB::raw("date_format(fechasistencias.fecha,'%d') as dia "))->where('asistencias.fk_iddocentes',$this->getidDocente())->where(DB::raw('month(fechasistencias.fecha)'),$request->mes)->where(DB::raw('year(fechasistencias.fecha)'),$request->year)->get();
        return $allregistros;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registrarsalida(Request $request)
    {

        $ip = $request->ip();
        $valor = Docente::where('clave', $request->firma)->where('iddocentes', $request->iddoc)->count();
        if ($valor == 1) {
            DB::insert('call p_asistencia(?,?,?,?,?,?,?,?,?,?,?)', [2, '', $request->fecha, $request->hora, $ip, bin2hex(random_bytes(10)), $request->iddoc, 1, '', $request->actividad, '']);
            $rpta = "1";
        } else {
            $rpta = "0";
        }
        return $rpta;
    }
    public function evidenciafile(Request $request)
    {
        $Datos = Docente::join('personas', 'docentes.fk_idpersonas', '=', 'personas.idpersonas')
            ->select('docentes.idDocentes', DB::raw('curdate() as dia'), DB::raw('curtime() as hora'))->where('personas.correo', auth()->user()->email)->first();
        $idsalida = Asistencia::join('fechasistencias', 'asistencias.fk_idfechasistencias', '=', 'fechasistencias.idfechasistencias')
            ->select( 'asistencias.fk_idasistenciasalidas')->where('asistencias.fk_iddocentes', $Datos->idDocentes)->where('fechasistencias.fecha', DB::raw('curdate()'))->first();
        $Archivos= $request->file('file')->store('public/Archivos');
        $url=Storage::url($Archivos);
        Evidencia::create([
            'docs'=>$url,
            'estado'=>1,
            'fk_idAsistenciaSalidas'=>$idsalida->fk_idasistenciasalidas
        ]);
    }

    public function store(Request $request)
    {

        $valor = Docente::where('clave', $request->firma)->where('iddocentes', $request->iddoc)->count();
        if ($valor == 1) {
            if($request->caso == 1){
            $img = $this->getB64Image($request->foto);
            $img_extension = $this->getB64Extension($request->foto);
            $img_name = time() . '.' . $img_extension;
            Storage::disk('docentesimg')->put($img_name, $img);
            $ruta = '/storage/docentesimg/' . $img_name;
            $ip = $request->ip();
            DB::insert('call p_asistencia(?,?,?,?,?,?,?,?,?,?,?)', [1, $ruta, $request->fecha, $request->hora, $ip, bin2hex(random_bytes(10)), $request->iddoc, 1, '', '', '']);
            $rpta = "1";
            }else{
                $ip = $request->ip();
                $ruta = '/storage/docentesimg/user.png'; 
                $rpta = DB::insert('call p_asistencia(?,?,?,?,?,?,?,?,?,?,?)', [1, $ruta, $request->fecha, $request->hora, $ip, bin2hex(random_bytes(10)), $request->iddoc, 1, '', '', '']);
            }
        } else {
            $rpta = "0";
        }

        return $rpta;
    }

    public function getB64Image($base64_image)
    {
        // Obtener el String base-64 de los datos         
        $image_service_str = substr($base64_image, strpos($base64_image, ",") + 1);
        // Decodificar ese string y devolver los datos de la imagen        
        $image = base64_decode($image_service_str);
        // Retornamos el string decodificado
        return $image;
    }
    public function getB64Extension($base64_image, $full = null)
    {
        // Obtener mediante una expresión regular la extensión imagen y guardarla
        // en la variable "img_extension"        
        preg_match("/^data:image\/(.*);base64/i", $base64_image, $img_extension);
        // Dependiendo si se pide la extensión completa o no retornar el arreglo con
        // los datos de la extensión en la posición 0 - 1
        return ($full) ?  $img_extension[0] : $img_extension[1];
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function detalleregistro(Request $request)
    {
        $fecha=$request->year."-".$request->mes."-".$request->dia;
        $detregistro = Asistencia::join('fechasistencias', 'asistencias.fk_idfechasistencias', '=', 'fechasistencias.idfechasistencias')
            ->join('asistenciaentradas', 'asistencias.fk_idasistenciaentradas', '=', 'asistenciaentradas.idasistenciaentradas')
            ->join('asistenciasalidas', 'asistencias.fk_idasistenciasalidas', '=', 'asistenciasalidas.idasistenciasalidas')
            ->join('firmas as m', 'asistenciaentradas.fk_idfirmas', '=', 'm.idfirmas')
            ->join('firmas as t', 'asistenciasalidas.fk_idfirmas', '=', 't.idfirmas')
            ->select('fechasistencias.fecha', 'asistenciaentradas.hor_entrada', 'asistenciaentradas.URL_foto','m.token as tkentrada' ,'asistenciasalidas.hor_salida','asistenciasalidas.informe','t.token as tksalida')->where('asistencias.fk_iddocentes', $this->getidDocente())->where('fechasistencias.fecha', $fecha)->first();
        return $detregistro;
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
