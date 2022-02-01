<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $horario=Horario::first();

        return view('URC.horario',compact('horario'));
    }

    public function update(Request $request)
    {
        $horario=Horario::find(1);
        $horario->ini_entrada=$request->entradadesde;
        $horario->fin_entrada=$request->entradahasta;
        $horario->ini_salida=$request->salidadesde;
        $horario->fin_salida=$request->salidahasta;

        $horario->save();

        return redirect()->route('horario');
    }
}
