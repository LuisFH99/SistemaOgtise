<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Solicitudes', function (Blueprint $table) {
            $table->id('idSolicitudes');
            $table->date('fech_solicitud');
            $table->time('hor_solicitud');
            $table->date('fech_inicio');
            $table->date('fech_fin');
            $table->date('fech_retorno');
            $table->mediumText('justificacion');
            $table->integer('num_dias');
            $table->string('reemplazo',100)->nullable();
            $table->string('firm_reemplazo',150)->nullable();
            $table->string('url_doc',100);
            $table->mediumText('observacion')->nullable();
            $table->string('codigo',45);
            $table->integer('estado');
           // $table->unsignedBigInteger('fk_idFirmas')->unique();
           // $table->foreign('fk_idFirmas')->references('idFirmas')->on('Firmas');
            $table->unsignedBigInteger('fk_idMotivoSolicitudes');
            $table->foreign('fk_idMotivoSolicitudes')->references('idMotivoSolicitudes')->on('MotivoSolicitudes');
            $table->unsignedBigInteger('fk_idEstadoSolicitudes');
            $table->foreign('fk_idEstadoSolicitudes')->references('idEstadoSolicitudes')->on('EstadoSolicitudes');
            $table->unsignedBigInteger('fk_idDocentes');
            $table->foreign('fk_idDocentes')->references('idDocentes')->on('Docentes');

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
        Schema::dropIfExists('Solicitudes');
    }
}
