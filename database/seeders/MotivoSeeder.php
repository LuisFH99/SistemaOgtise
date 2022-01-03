<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MotivoSolicitud;

class MotivoSeeder extends Seeder

{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

    {
        $motivos1=new MotivoSolicitud();
        $motivos1-> motivo='CS-COMISION DE SERVICIO';
        $motivos1->save();

        $motivos2=new MotivoSolicitud();
        $motivos2-> motivo='AV-A CUENTA DE VACACIONES';
        $motivos2->save();

        $motivos3=new MotivoSolicitud();
        $motivos3-> motivo='SH-ASUNTOS PARTICULARES';
        $motivos3->save();

        $motivos4=new MotivoSolicitud();
        $motivos4-> motivo='EN-ENFERMEDAD';
        $motivos4->save();

        $motivos5=new MotivoSolicitud();
        $motivos5-> motivo='VA-VACACIONES';
        $motivos5->save();

        $motivos6=new MotivoSolicitud();
        $motivos6-> motivo='CO-COMPENSACION';
        $motivos6->save();

        $motivos7=new MotivoSolicitud();
        $motivos7-> motivo='CAPACITACION';
        $motivos7->save();
    
        $motivos8=new MotivoSolicitud();
        $motivos8-> motivo='GR- GRAVIDEZ';
        $motivos8->save();
         

        $motivos9=new MotivoSolicitud();
        $motivos9-> motivo='ON- ONOMASTICO';
        $motivos9->save();


        $motivos10=new MotivoSolicitud();
        $motivos10-> motivo='SL- SEPELIO Y LUTO';
        $motivos10->save();


        $motivos11=new MotivoSolicitud();
        $motivos11-> motivo='OT- CITAS MEDICAS';
        $motivos11->save();

        $motivos12=new MotivoSolicitud();
        $motivos12-> motivo='PA- PATERNIDAD';
        $motivos12->save();

        $motivos13=new MotivoSolicitud();
        $motivos13-> motivo='OL- ONCOLOGIA';
        $motivos13->save();

        
    }
}
