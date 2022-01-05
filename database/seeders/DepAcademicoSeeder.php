<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DepAcademico;

class DepAcademicoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

        {
        $departac1=new DepAcademico();
        $departac1-> nomdep='Ciencias Básicas';
        $departac1-> correo='decanaturafc@unasam.edu.pe';     
        $departac1-> fk_idFacultades='1';        
        $departac1->save();

        $departac2=new DepAcademico();
        $departac2-> nomdep='Matemática';
        $departac2-> correo='decanaturafc@unasam.edu.pe';
        $departac2-> fk_idFacultades='1';        
        $departac2->save();

        $departac3=new DepAcademico();
        $departac3-> nomdep='Estadística';
        $departac3-> correo='decanaturafc@unasam.edu.pe'; 
        $departac3-> fk_idFacultades='1';       
        $departac3->save();

        $departac4=new DepAcademico();
        $departac4-> nomdep='Ingeniería de Sistemas y Telecomunicaciones';
        $departac4-> correo='decanaturafc@unasam.edu.pe'; 
        $departac4-> fk_idFacultades='1';       
        $departac4->save();

        $departac5=new DepAcademico();
        $departac5-> nomdep='Ciencia y Tecnología de Alimentos';
        $departac5-> correo='decanaturafiia@unasam.edu.pe';  
        $departac5-> fk_idFacultades='2';       
        $departac5->save();

        $departac6=new DepAcademico();
        $departac6-> nomdep='Ingeniería Industrial';
        $departac6-> correo='decanaturafiia@unasam.edu.pe'; 
        $departac6-> fk_idFacultades='2';          
        $departac6->save();

        $departac7=new DepAcademico();
        $departac7-> nomdep='Agronomía';
        $departac7-> correo='decanaturafca@unasam.edu.pe';        
        $departac7-> fk_idFacultades='3';   
        $departac7->save();
        
        $departac8=new DepAcademico();
        $departac8-> nomdep='Ingeniería Agrícola';
        $departac8-> correo='decanaturafca@unasam.edu.pe'; 
        $departac8-> fk_idFacultades='3';       
        $departac8->save();

        $departac9=new DepAcademico();
        $departac9-> nomdep='Ingeniería Civil';
        $departac9-> correo='decanaturafic@unasam.edu.pe'; 
        $departac9-> fk_idFacultades='4';       
        $departac9->save();

        $departac10=new DepAcademico();
        $departac10-> nomdep='Arquitectura';
        $departac10-> correo='decanaturafic@unasam.edu.pe';  
        $departac10-> fk_idFacultades='4';           
        $departac10->save();

        $departac11=new DepAcademico();
        $departac11-> nomdep='Ingeniería de Minas y Geología';
        $departac11-> correo='decanaturafimgm@unasam.edu.pe'; 
        $departac11-> fk_idFacultades='5';            
        $departac11->save();

        $departac12=new DepAcademico();
        $departac12-> nomdep='Ciencias del Ambiente';
        $departac12-> correo='decanaturafcam@unasam.edu.pe'; 
        $departac12-> fk_idFacultades='6';            
        $departac12->save();

        $departac13=new DepAcademico();
        $departac13-> nomdep='Ingeniería Sanitaria';
        $departac13-> correo='decanaturafcam@unasam.edu.pe'; 
        $departac13-> fk_idFacultades='6';            
        $departac13->save();


        $departac14=new DepAcademico();
        $departac14-> nomdep='Economía';
        $departac14-> correo='decanaturafec@unasam.edu.pe';   
        $departac14-> fk_idFacultades='7';          
        $departac14->save();

        $departac15=new DepAcademico();
        $departac15-> nomdep='Contabilidad';
        $departac15-> correo='decanaturafec@unasam.edu.pe'; 
        $departac15-> fk_idFacultades='7';          
        $departac15->save();

        $departac16=new DepAcademico();
        $departac16-> nomdep='Administración';
        $departac16-> correo='decanaturafat@unasam.edu.pe';  
        $departac16-> fk_idFacultades='8';         
        $departac16->save();

        $departac17=new DepAcademico();
        $departac17-> nomdep='Turismo';
        $departac17-> correo='decanaturafat@unasam.edu.pe';  
        $departac17-> fk_idFacultades='8';               
        $departac17->save();


        $departac18=new DepAcademico();
        $departac18-> nomdep='Propedéutica';
        $departac18-> correo='decanaturafcm@unasam.edu.pe';
        $departac18-> fk_idFacultades='9';                 
        $departac18->save();

        $departac19=new DepAcademico();
        $departac19-> nomdep='Obstetricia';
        $departac19-> correo='decanaturafcm@unasam.edu.pe';  
        $departac19-> fk_idFacultades='9';      
        $departac19->save();
        
        $departac20=new DepAcademico();
        $departac20-> nomdep='Enfermería';
        $departac20-> correo='decanaturafcm@unasam.edu.pe'; 
        $departac20-> fk_idFacultades='9';       
        $departac20->save();

        $departac21=new DepAcademico();
        $departac21-> nomdep='Derecho y Ciencias Políticas';
        $departac21-> correo='decanaturafdccpp@unasam.edu.pe';  
        $departac21-> fk_idFacultades='10';      
        $departac21->save();

        $departac22=new DepAcademico();
        $departac22-> nomdep='Educación';
        $departac22-> correo='decanaturafcsec@unasam.edu.pe';   
        $departac22-> fk_idFacultades='11';     
        $departac22->save();

        $departac23=new DepAcademico();
        $departac23-> nomdep='Ciencias Sociales';
        $departac23-> correo='decanaturafcsec@unasam.edu.pe'; 
        $departac23-> fk_idFacultades='11';         
        $departac23->save();

        $departac24=new DepAcademico();
        $departac24-> nomdep='Ciencias de la Comunicación';
        $departac24-> correo='decanaturafcsec@unasam.edu.pe';  
        $departac24-> fk_idFacultades='11';        
        $departac24->save();

        $departac25=new DepAcademico();
        $departac25-> nomdep='Arqueología';
        $departac25-> correo='decanaturafcsec@unasam.edu.pe';        
        $departac25-> fk_idFacultades='11';  
        $departac25->save();
        //
    }
}
