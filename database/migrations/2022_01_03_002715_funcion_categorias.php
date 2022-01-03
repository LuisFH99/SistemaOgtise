<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FuncionCategorias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $funcion = "CREATE FUNCTION `f_categoria`(cat varchar(50), ded varchar(50)) RETURNS varchar(5) CHARSET utf8mb3 COLLATE utf8_unicode_ci
        READS SQL DATA
        DETERMINISTIC
    BEGIN
    declare dto int default 1;
    declare rst varchar(5);
    if(cat='Auxiliar') then
    set dto=3;
    set rst= concat(upper(substring(trim(cat),dto,1)),upper(substring(substring_index(trim(ded),' ',1),1,1)),
    upper(substring(substring_index(trim(ded),' ',-1),1,1)));
    else
    set rst= concat(upper(substring(trim(cat),dto,1)),upper(substring(substring_index(trim(ded),' ',1),1,1)),
    upper(substring(substring_index(trim(ded),' ',-1),1,1)));
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
        $funcion="DROP FUNCTION IF EXISTS f_categoria";
        DB::unprepared( $funcion);
    }
}
