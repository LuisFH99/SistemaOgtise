<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FuncionVerificarHorarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $funcion="CREATE FUNCTION `f_verificar_horario`(idd int,fech date) RETURNS tinyint(1)
        READS SQL DATA
        DETERMINISTIC
    BEGIN
    --  DECLARE dt boolean DEFAULT false;
     DECLARE rst boolean DEFAULT false;
     declare fch varchar(15);
     declare idsem int;
     set fch= (select CONCAT(ELT(WEEKDAY(fech) + 1, 'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo')));
     set idsem=( select idsemanas from semanas where dia=fch);
     if (select count(*) from detsemanas where fk_iddocentes=idd and fk_idsemanas=idsem)=1 then 
     set rst=true; 
     end if; 
    RETURN rst;
    END";
    DB::unprepared( $funcion);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $funcion="DROP FUNCTION IF EXISTS f_verificar_horario";
        DB::unprepared( $funcion);
    }
}
