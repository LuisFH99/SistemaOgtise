<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Semana;
class SemanaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dia1=new Semana();
        $dia1-> dia='Lunes';
        $dia1->save();

        $dia2=new Semana();
        $dia2-> dia='Martes';
        $dia2->save();

         $dia3=new Semana();
        $dia3-> dia='Miercoles';
        $dia3->save();

         $dia4=new Semana();
        $dia4-> dia='Jueves';
        $dia4->save();

        $dia5=new Semana();
        $dia5-> dia='Viernes';
        $dia5->save();

        //
    }
}
