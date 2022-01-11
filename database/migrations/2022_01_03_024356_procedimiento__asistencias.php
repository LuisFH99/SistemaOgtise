<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProcedimientoAsistencias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedimiento="CREATE  PROCEDURE `p_asistencia`(ev int, url_f varchar(100),ff date,hh time,firm varchar(100),tk varchar(45), idd int,idtf int, evid mediumtext, infor mediumtext,obs mediumtext)
        BEGIN
        declare idfech int;
        set idfech=(select idfechasistencias  from fechasistencias where fecha=ff);
        case ev
        when 1 then -- registrar entrada
        -- editar firma
        update firmas set firma=firm, token=tk, FK_idtipfirmas=idtf,created_at=now()
        where idfirmas=(select fk_idfirmas from asistenciaentradas where idasistenciaentradas=
        (select fk_idasistenciaentradas from asistencias where fk_idfechasistencias=idfech and fk_iddocentes=idd));
        -- editar asistencia entrada
        update asistenciaentradas set hor_entrada=hh,
        URL_foto=url_f,created_at=now() where idasistenciaentradas=(select fk_idasistenciaentradas from asistencias 
        where fk_idfechasistencias=idfech and fk_iddocentes=idd);
        -- editar estado de asistencia
        update asistencias set fk_idestadoasistencias=6, created_at=now()where fk_iddocentes=idd and fk_idfechasistencias=idfech;
        when 2 then -- registrar salida
        -- editar firma
        update firmas set firma=firm, token=tk, fk_idtipfirmas=idtf 
        where idfirmas=(select fk_idfirmas from asistenciasalidas where idasistenciasalidas=
        (select fk_idasistenciasalidas from asistencias where fk_idfechasistencias=idfech and fk_iddocentes=idd));
        -- editar asistencia salida
        update asistenciasalidas set hor_salida=hh,
        informe=infor, created_at=now() where idasistenciasalidas=
        (select fk_idasistenciasalidas from asistencias where fk_idfechasistencias=idfech and fk_iddocentes=idd);
        -- editar estado de asistencia
        update asistencias set fk_idestadoasistencias=1 where fk_iddocentes=idd and fk_idfechasistencias=idfech;
        end case;
        END";
        DB::unprepared( $procedimiento);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $procedimiento="DROP PROCEDURE IF EXISTS p_asistencia";
        DB::unprepared( $procedimiento);
    }
}
