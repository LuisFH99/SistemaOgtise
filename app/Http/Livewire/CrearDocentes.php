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
        
        return view('livewire.crear-docentes', compact('facultades'));
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
