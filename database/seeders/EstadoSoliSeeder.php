<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EstadoSolicitud;

class EstadoSoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $esolicitud1=new EstadoSolicitud();
        $esolicitud1-> estadoSol='Enviado';
        $esolicitud1->save();

        $esolicitud2=new EstadoSolicitud();
        $esolicitud2-> estadoSol='Proceso Visto Bueno Aprobado Denegado';
        $esolicitud2->save();

        $esolicitud3=new EstadoSolicitud();
        $esolicitud3-> estadoSol='Visto Bueno';
        $esolicitud3->save();

        $esolicitud4=new EstadoSolicitud();
        $esolicitud4-> estadoSol='Aprobado';
        $esolicitud4->save();

        $esolicitud5=new EstadoSolicitud();
        $esolicitud5-> estadoSol='Denegado';
        $esolicitud5->save();

        //
    }
}
