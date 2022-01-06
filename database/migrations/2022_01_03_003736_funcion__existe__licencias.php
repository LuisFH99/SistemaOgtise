<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FuncionExisteLicencias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $funcion="CREATE FUNCTION `f_existe_licencia`(idd int) RETURNS tinyint(1)
        READS SQL DATA
        DETERMINISTIC
    BEGIN
    DECLARE rst boolean DEFAULT false;
    if(select count(*) from solicitudes where fk_idDocentes=idd)>0 then 
     if(select count(*) from solicitudes where fk_idEstadoSolicitudes=4 and fk_idDocentes=idd)>0 then 
      if (select count(*) from solicitudes where curdate()   BETWEEN  fech_inicio and fech_fin and fk_idDocentes=idd)=1 then
       SET rst = true;
      end if;
     end if;
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
        $funcion="DROP FUNCTION IF EXISTS f_existe_licencia";
        DB::unprepared( $funcion);
    }
}
