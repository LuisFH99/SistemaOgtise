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
        declare idp integer;
        declare iddoc integer;
        -- declare cor_inst varchar(150);
        case ev
        when 1 then 
        if(select count(*) from personas where DNI=ident)=0 then 
        if(select count(*) from docentes where fk_idpersonas=(select idpersonas from personas where DNI=ident))=0 then
        -- set cor_inst=(select f_correo(nom, app, apm));
        insert into personas(DNI, nombres, apellPat, apellMat, fechNacimiento,correo , telefono, estado, created_at)
        values(ident,nom,app,apm,fch_nac,cor,tel,1,now());
        set idp=(select idpersonas from personas where DNI=ident);
        insert into docentes(clave, estado, fk_idPersonas, fk_idCategorias, fk_idCondiciones, fk_idDedicaciones,
         fk_idDepAcademicos, created_at) 
        values(clav,1,idp,idcat,idcon,idded,iddep,now());   
        
        -- ************************************ insertar user
         insert into users(name, email, email_verified_at, password, remember_token, created_at)
        values((select concat(nom,' ',app,' ',apm )),cor,now(),psw,'',now());
        -- ************************************insertar semanas
        set iddoc= (select idDocentes from docentes where fk_idPersonas=( select idPersonas from personas where DNI=ident));
        call cursor_semanas(iddoc);
        -- **********
        select concat('El docente',nom,' ',app,' ',apm,'se ingreso corectamente');
        end if;
        end if;
          
        -- *************************************
        when 2 then -- editar docente
        -- if(select count(*) from personas where DNI=ident)=1 then 
        -- if(select count(*) from docentes where fk_idpersonas=(select idpersonas from personas where DNI=ident))=1 then
        -- set cor_inst=(select f_correo(nom, app, apm));
        update personas set DNI= ident, nombres=nom, apellPat=app, apellMat=apm, fechNacimiento=fch_nac,
        correo=cor , telefono=tel, updated_at=now() where idpersonas=idper;
        update docentes set clave=clav, fk_idCategorias=idcat, fk_idCondiciones=idcon, fk_idDedicaciones=idded,
         fk_idDepAcademicos=iddep, updated_at=now() where fk_idpersonas=idper;
        update users set name=(select concat(nom,' ',app,' ',apm )), email=cor,
         email_verified_at=now() ,password=psw, updated_at=now() where id=idus;
         select concat('El docente ',nom,' ',app,' ',apm,'se edito');
        -- end if;
        -- end if;
        when 3 then --  eliminar docente
        if(select count(*) from personas where DNI=ident)=1 then 
        if(select count(*) from docentes where fk_idpersonas=(select idpersonas from personas where DNI=ident))=1 then
        update personas set estado=0 where idpersonas=idper;
        update docentes set estado=0 where fk_idpersonas=idper;
        delete from users where id=idus;
        delete from detsemanas where fk_iddocentes=(select iddocentes from docentes where fk_idpersonas=idper);
        select concat('El docente ',nom,' ',app,' ',apm,' se elimino corectamente');
         end if;
         end if;
         when 4 then 
         
        set idp=(select idpersonas from personas where DNI=ident);
        if(select estado from personas where DNI=ident)=0 then
        if(select estado from docentes where fk_idPersonas=(select idpersonas from personas where DNI=ident))=0 then 
        -- *** persona
        update personas set estado=1, nombres=nom, apellPat=app, apellMat=apm, fechNacimiento=fch_nac,
        correo=cor, telefono=tel, created_at=now() where idpersonas=idp;
        update docentes set estado=1, clave=clav, fk_idCategorias=idcat, fk_idCondiciones=idcon, fk_idDedicaciones=idded,
         fk_idDepAcademicos=iddep, created_at=now() where fk_idpersonas=idp;
        -- ************************************ insertar user
         insert into users(name, email, email_verified_at, password, remember_token, created_at)
        values((select concat(nom,' ',app,' ',apm )),cor,now(),psw,'',now());
        -- ***
        set iddoc= (select idDocentes from docentes where fk_idPersonas=( select idPersonas from personas where DNI=ident));
        call cursor_semanas(iddoc);
        select concat('El docente se volvio a crear corectamente');
        end if; 
        end if;
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
        $procedimiento="DROP FUNCTION IF EXISTS p_crear_docente";
        DB::unprepared( $procedimiento);
    }
}
