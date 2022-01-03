<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Facultad;

class FacultadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $facultad1=new Facultad();
        $facultad1-> nomFac='Ciencias';
        $facultad1-> correo='mesadepartesfc@unasam.edu.pe';        
        $facultad1->save();

        $facultad2=new Facultad();
        $facultad2-> nomFac='Ingeniería de Industrias Alimentarias';
        $facultad2-> correo='mesadepartesfiia@unasam.edu.pe';        
        $facultad2->save();

        $facultad3=new Facultad();
        $facultad3-> nomFac='Ciencias Agrarias';
        $facultad3-> correo='mesadepartesfca@unasam.edu.pe';        
        $facultad3->save();

        $facultad4=new Facultad();
        $facultad4-> nomFac='Ingeniería Civil';
        $facultad4-> correo='mesadepartesfic@unasam.edu.pe';      
        $facultad4->save();

         $facultad5=new Facultad();
        $facultad5-> nomFac='Ingeniería de Minas, Geología y Metalurgia';
        $facultad5-> correo='mesadepartesfimgm@unasam.edu.pe';      
        $facultad5->save();
        

        $facultad6=new Facultad();
        $facultad6-> nomFac='Ciencias del Ambiente';
        $facultad6-> correo='mesadepartesfcam@unasam.edu.pe';      
        $facultad6->save();

        $facultad7=new Facultad();
        $facultad7-> nomFac='Economía y Contabilidad';
        $facultad7-> correo='mesadepartesfec@unasam.edu.pe';      
        $facultad7->save();

        $facultad8=new Facultad();
        $facultad8-> nomFac='Administración y Turismo';
        $facultad8-> correo='mesadepartesfat@unasam.edu.pe';      
        $facultad8->save();

         $facultad9=new Facultad();
        $facultad9-> nomFac='Ciencias Médicas';
        $facultad9-> correo='mesadepartesfcm@unasam.edu.pe';      
        $facultad9->save();


         $facultad10=new Facultad();
        $facultad10-> nomFac='Derecho y Ciencias Políticas';
        $facultad10-> correo='mesadepartesfdccpp@unasam.edu.pe';      
        $facultad10->save();

        
        $facultad11=new Facultad();
        $facultad11-> nomFac='Ciencias Sociales, Educación y de la Comunicación';
        $facultad11-> correo='mesadepartesfcsec@unasam.edu.pe';      
        $facultad11->save();
        //segruir los mismos pasos
        //
    }
}
