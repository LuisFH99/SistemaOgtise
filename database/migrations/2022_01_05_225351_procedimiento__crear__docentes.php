<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProcedimientoCrearDocentes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $procedimiento="CREATE PROCEDURE `p_crear_docente`(ev int ,ident varchar(8),nom varchar(100),
        app varchar(80),apm varchar(80),fch_nac date, tel varchar(10),clav varchar(40),idcon int,idcat int,idded int,
        iddep int, idper int, psw varchar(100), idus int,cor varchar(200))
        BEGIN
        
        declare iddoc integer;
        
        case ev
        when 1 then 
            insert into personas(DNI, nombres, apellPat, apellMat, fechNacimiento,correo , telefono, estado, created_at)
            values(ident,nom,app,apm,fch_nac,cor,tel,1,now());
            set @iper=(select idpersonas from personas where DNI=ident);
            insert into docentes(clave, estado, fk_idPersonas, fk_idCategorias, fk_idCondiciones, fk_idDedicaciones, fk_idDepAcademicos, created_at) 
            values(clav,1,@iper,idcat,idcon,idded,iddep,now());   
            set iddoc= (select idDocentes from docentes where fk_idPersonas=@iper);
             call cursor_semanas(iddoc);
          
        when 2 then -- editar docente
        
            update personas set DNI= ident, nombres=nom, apellPat=app, apellMat=apm, fechNacimiento=fch_nac, correo=cor , telefono=tel, updated_at=now() where idpersonas=idper;
            update docentes set clave=clav, fk_idCategorias=idcat, fk_idCondiciones=idcon, fk_idDedicaciones=idded, fk_idDepAcademicos=iddep, updated_at=now() where fk_idpersonas=idper;
            update users set name=(select concat(nom,' ',app,' ',apm )), email=cor, email_verified_at=now() ,password=psw, updated_at=now() where id=idus;
            select concat('Los Datos del Docente ',nom,' ',app,' ',apm,' se actualizaron de forma correcta') as rpta;
        
        when 3 then --  eliminar docente
            update personas set estado=0 where idpersonas=idper;
            update docentes set estado=0 where fk_idpersonas=idper;
            delete from users where id=idus;
            select 1 as rpta;
            
         when 4 then
            set @iper=(select idpersonas from personas where DNI=ident);
            update personas set estado=1, nombres=nom, apellPat=app, apellMat=apm, fechNacimiento=fch_nac, correo=cor, telefono=tel, created_at=now() where idpersonas=@iper;
            update docentes set estado=1, clave=clav, fk_idCategorias=idcat, fk_idCondiciones=idcon, fk_idDedicaciones=idded, fk_idDepAcademicos=iddep, created_at=now() where fk_idpersonas=@iper;
            set iddoc= (select idDocentes from docentes where fk_idPersonas=( select idPersonas from personas where DNI=ident));
            call cursor_semanas(iddoc);
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
        $procedimiento="DROP PROCEDURE IF EXISTS p_crear_docente";
        DB::unprepared( $procedimiento);    
    }
}
