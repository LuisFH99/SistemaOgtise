<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FuncionExepcionDias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $funcion="CREATE FUNCTION `f_excepcion_dias`( fech date) RETURNS tinyint(1)
        READS SQL DATA
        DETERMINISTIC
    BEGIN
    DECLARE rst boolean DEFAULT false;
    DECLARE dia int;
    DECLARE mes int;
    DECLARE nom_dia VARCHAR(45);
    SET dia=(select DAY(fech));
    SET mes=(select MONTH (fech));
    SET nom_dia=(SELECT DAYNAME(fech));
    case
    when dia=1 and mes=1 then set rst=true;  -- Año nuevo
    when dia=3 and mes=1 then set rst=true; -- día no laborable
    /* when dia=14 and mes=4 then set rst=true; -- Jueves Santo
    when dia=15 and mes=4 then set rst=true; -- Viernes Santo */
    when dia=1 and mes=5 then set rst=true;  -- Dia del trabajador
    when dia=29 and mes=6 then set rst=true;-- San Pedro y San Pablo
    when dia=28 and mes=7 then set rst=true;  -- Fiestas patrias
    when dia=29 and mes=7 then set rst=true;  -- Fiestas patrias
    when dia=30 and mes=8 then set rst=true; -- Santa Rosa de Lima
    when dia=8 and mes=10 then set rst=true;-- Combate Naval de Angamos
    when dia=1 and mes=11 then set rst=true; -- Día de todos los Santos
    when dia=8 and mes=12 then set rst=true; -- Inmaculada Concepción
    when dia=25 and mes=12 then set rst=true; -- Navidad
    -- when nom_dia='Saturday' then set rst=true;
    -- when nom_dia='Sunday' then set rst=true;
    else set rst= false;
    end case;
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
        $funcion="DROP FUNCTION IF EXISTS f_excepcion_dias";
        DB::unprepared( $funcion);
    }
}
