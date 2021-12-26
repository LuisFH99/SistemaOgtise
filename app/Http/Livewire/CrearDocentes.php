<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Categoria;
use App\Models\Dedicacion;
use App\Models\Facultad;
use App\Models\DepAcademico;
use App\Models\Condicion;

class CrearDocentes extends Component
{
    public $selectFacultad = null;
    public $depacademicos ;

    public function render()
    {
        $facultades = Facultad::all();
        $condiciones = Condicion::all();
        $categorias = Categoria::all();
        $dedicaciones = Dedicacion::all();
        return view('livewire.crear-docentes', compact('facultades', 'condiciones', 'categorias', 'dedicaciones'));
        // return view('livewire.crear-docentes', [
        //     'facultades' => Facultad::all()
        // ]);
    }

    public function updatedselectFacultad($idfacultad)
    {
        $this->depacademicos = DB::table('depacademicos')->where('fk_idFacultades', '=', $idfacultad)->get();
        // $this->depacademicos = DepAcademico::where('fk_idFacultades',$idfacultad);
    }
    
}
