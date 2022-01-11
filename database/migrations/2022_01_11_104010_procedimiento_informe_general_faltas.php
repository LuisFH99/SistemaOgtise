<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ProcedimientoInformeGeneralFaltas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       $rocedimiento="CREATE PROCEDURE `P_InformeGeneralFaltas`(dia date)
       BEGIN
       select id_facultades, nomfac,
                   (
                       select 
                       JSON_ARRAYAGG(JSON_OBJECT('id',m.iddepacademicos,'dep',m.nomdep,
                       'cant',(
                               select count(*) 
                               from asistencias a inner join docentes d on a.fk_iddocentes=d.iddocentes
                               inner join fechasistencias h on a.fk_idfechasistencias=h.idfechasistencias
                               where d.fk_idDepAcademicos=m.iddepacademicos and a.fk_idEstadoAsistencias <> 1 and a.fk_idEstadoAsistencias <> 6 and h.fecha=dia
                           ),
                       'docentes',(
                           select JSON_ARRAYAGG(JSON_OBJECT('nombres',concat_ws(' ', p.apellpat,p.apellmat,p.nombres),'dni',p.dni,'condicion',n.nomcondi,'categoria',c.nomcat,'dedicacion',e.nomdedi,
                           'cargo',(
                               select  c.cargo
                                   from autoridades a  
                                   inner join cargos c on a.fk_idCargos=c.idcargos
                                   where a.fk_idDocentes=d.iddocentes
                           ),
                           'datoasistencias',(
                               select  JSON_ARRAYAGG(JSON_OBJECT('estado',a.fk_idEstadoAsistencias,'entrada',i.hor_entrada,'foto',i.URL_foto,'firmae',r.firma,'tkentrada',r.token,'salida',s.hor_salida,'firmas',t.firma,'tksalida',t.token)) 
                                   from asistencias a
                                   inner join fechasistencias h on a.fk_idfechasistencias=h.idfechasistencias
                                   inner join asistenciaentradas i on a.fk_idasistenciaentradas=i.idasistenciaentradas
                                   inner join asistenciasalidas s on a.fk_idasistenciasalidas=s.idasistenciasalidas
                                   inner join firmas r on i.fk_idfirmas=r.idfirmas
                                   inner join firmas t on s.fk_idfirmas=t.idfirmas 
                                   where a.fk_iddocentes=d.iddocentes and h.fecha=dia and a.fk_idEstadoAsistencias <> 1 and a.fk_idEstadoAsistencias <> 6
                           )
                           ))
                           from docentes d inner join personas p on d.fk_idpersonas=p.idpersonas
                               inner join condiciones n on d.fk_idcondiciones=n.idcondiciones
                               inner join categorias c on d.fk_idcategorias=c.idcategorias
                               inner join dedicaciones e on d.fk_iddedicaciones=e.iddedicaciones 
                               where d.estado=1 and p.estado=1 and d.fk_idDepAcademicos=m.iddepacademicos
                       )
                       ))
                       from
                       depacademicos m
                       where f.id_facultades=m.fk_idfacultades
                   ) as departamentos
               from facultades f ;
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
        $procedimiento="DROP PROCEDURE IF EXISTS P_InformeGeneralFaltas";
        DB::unprepared( $procedimiento);
    }
}
