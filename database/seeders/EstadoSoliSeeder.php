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
        $esolicitud1-> estadoSol='Enviada';
        $esolicitud1->save();

        $esolicitud2=new EstadoSolicitud();
        $esolicitud2-> estadoSol='Procesada';
        $esolicitud2->save();

        $esolicitud3=new EstadoSolicitud();
        $esolicitud3-> estadoSol='Visto Bueno';
        $esolicitud3->save();

        $esolicitud4=new EstadoSolicitud();
        $esolicitud4-> estadoSol='Admitida';
        $esolicitud4->save();

        $esolicitud5=new EstadoSolicitud();
        $esolicitud5-> estadoSol='Aprobada';
        $esolicitud5->save();

        $esolicitud6=new EstadoSolicitud();
        $esolicitud6-> estadoSol='Denegada';
        $esolicitud6->save();

        //
    }
}
