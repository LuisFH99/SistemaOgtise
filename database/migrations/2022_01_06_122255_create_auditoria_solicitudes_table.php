<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditoriaSolicitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditoriaSolicitudes', function (Blueprint $table) {
            $table->id('idauditoriaSolicitudes');
            $table->integer('idsolicitud');
            $table->string('fech_solicitud',100);
            $table->string('hor_solicitud',100);
            $table->string('fech_inicio',100);
            $table->string('fech_fin',100);
            $table->string('fech_retorno',100);
            $table->mediumText('justificacion');
            $table->string('num_dias',100);
            $table->string('url_doc',300); 
            $table->mediumText('observacion')->nullable();
            $table->string('codigo',150);
            $table->string('motivo',150);
            $table->string('estadoSolicitud',150);
            $table->integer('iddocente');
            $table->string('estado',45);
            $table->string('usuario',85);
            $table->string('accion',45);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auditoriaSolicitudes');
    }
}
