<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProcedimientoCursorAsistencias extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedimiento="CREATE  PROCEDURE `P_cursor_Asistencias`()
        BEGIN
        -- Variables donde almacenar lo que nos traemos desde el SELECT
          DECLARE v_id integer;
        -- Variable para controlar el fin del bucle
          DECLARE fin INTEGER DEFAULT 0;
        -- El SELECT que vamos a ejecutar
          DECLARE cursorDocente CURSOR FOR
            SELECT idDocentes FROM docentes where estado=1;
        
        -- Condición de salida
          DECLARE CONTINUE HANDLER FOR NOT FOUND SET fin=1;
        
          OPEN cursorDocente;
          bucle: LOOP
            FETCH cursorDocente INTO v_id;
            IF fin = 1 THEN
               LEAVE bucle;
            END IF;
        if(f_verificar_horario(v_id, curdate()))=1 then
        -- *******
        if (select count(*) from fechasistencias where fecha=CURDATE( ))=0 then
        insert into fechasistencias(fecha, dia) value
        ((SELECT CURDATE()),(SELECT DAYNAME(NOW())));
        end if;
        insert into firmas(firma, token, estado, fk_idTipFirmas) 
        values('-','-',1,1);
        insert into asistenciaentradas(hor_entrada, URL_foto, estado, fk_idFirmas)
        values('00:00:00','-',1,(SELECT MAX(idFirmas) AS idFirmas FROM firmas));
        
        insert into firmas(firma, token, estado, fk_idTipFirmas) 
        values('-','-',1,1);
        insert into asistenciasalidas(hor_salida, informe, estado, fk_idFirmas) 
        values('00:00:00',' ',1,(SELECT MAX(idFirmas) AS idFirmas FROM Firmas)); 
        if (SELECT f_existe_licencia(v_id))=1 then
        insert into asistencias(observacion, estado, fk_idAsistenciaSalidas, fk_idAsistenciaEntradas, 
        fk_idFechAsistencias, fk_idEstadoAsistencias, fk_idDocentes)
        values('',1,(SELECT MAX(idAsistenciaSalidas) AS idAsistenciaSalidas FROM AsistenciaSalidas),
        (SELECT MAX(idAsistenciaEntradas) AS idAsistenciaEntradas FROM AsistenciaEntradas),
        (select idFechAsistencias from fechasistencias where fecha=CURDATE( )),4,v_id);
        else 
        if(select f_excepcion_dias(curdate()))=1 then
        insert into asistencias(observacion, estado, fk_idAsistenciaSalidas, fk_idAsistenciaEntradas, 
        fk_idFechAsistencias, fk_idEstadoAsistencias, fk_idDocentes)
        values('',1,(SELECT MAX(idAsistenciaSalidas) AS idAsistenciaSalidas FROM AsistenciaSalidas),
        (SELECT MAX(idAsistenciaEntradas) AS idAsistenciaEntradas FROM AsistenciaEntradas),
        (select idFechAsistencias from fechasistencias where fecha=CURDATE( )),5,v_id);
        else
        insert into asistencias(observacion, estado, fk_idAsistenciaSalidas, fk_idAsistenciaEntradas, 
        fk_idFechAsistencias, fk_idEstadoAsistencias, fk_idDocentes)
        values('',1,(SELECT MAX(idAsistenciaSalidas) AS idAsistenciaSalidas FROM AsistenciaSalidas),
        (SELECT MAX(idAsistenciaEntradas) AS idAsistenciaEntradas FROM AsistenciaEntradas),
        (select idFechAsistencias from fechasistencias where fecha=CURDATE( )),2,v_id);
        end if;
        end if;
        -- *****
        end if;
          END LOOP bucle;
          CLOSE cursorDocente;
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
        $procedimiento="DROP PROCEDURE IF EXISTS P_cursor_Asistencias";
        DB::unprepared( $procedimiento);
    }
}
