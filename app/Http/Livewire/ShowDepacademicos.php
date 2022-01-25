<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Facultad;

class ShowDepacademicos extends Component
{
    public $selectFacultad = null;
    public $depacademicos ;

    public function render()
    {
        $facultades = Facultad::all();

        return view('livewire.show-depacademicos',compact('facultades'));
        
    }

    public function updatedselectFacultad($idfacultad)
    {
        $this->depacademicos = DB::table('depacademicos')->where('fk_idFacultades', '=', $idfacultad)->get();
        // $this->depacademicos = DepAcademico::where('fk_idFacultades',$idfacultad);
    }
}
