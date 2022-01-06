<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EstadoAsistencia;

class EstadoasisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $estado1=new EstadoAsistencia();
        $estado1-> estado='Asistio';
        $estado1->save();

         $estado2=new EstadoAsistencia();
        $estado2-> estado='Falto';
        $estado2->save();

         $estado3=new EstadoAsistencia();
        $estado3-> estado='Justificado';
        $estado3->save();

         $estado4=new EstadoAsistencia();
        $estado4-> estado='Licencia';
        $estado4->save();

         $estado5=new EstadoAsistencia();
        $estado5-> estado='No laborable';
        $estado5->save();

        //
    }
}
