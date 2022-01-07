<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProcedimientoCursorSemanas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedimiento="CREATE PROCEDURE `cursor_semanas`(idd int)
        READS SQL DATA
        DETERMINISTIC
    BEGIN
    -- inicializacion de cursor
      DECLARE v_id integer;
      DECLARE fin INTEGER DEFAULT 0;
      DECLARE c_idsemanas CURSOR FOR SELECT idsemanas FROM semanas;
     DECLARE CONTINUE HANDLER FOR NOT FOUND SET fin=1;
    -- *****
    OPEN c_idsemanas;
      bucle: LOOP
        FETCH c_idsemanas INTO v_id;
        IF fin = 1 THEN
           LEAVE bucle;
        END IF;
            insert into detsemanas(fk_idDocentes, fk_idSemanas, created_at, updated_at)
            value(idd,v_id,now(),now());
        END LOOP bucle;
      CLOSE c_idsemanas;
    END";
    DB::unprepared($procedimiento);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $procedimiento="DROP PROCEDURE IF EXISTS cursor_semanas";
        DB::unprepared( $procedimiento);
    }
}
