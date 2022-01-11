<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditarAsistenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditarAsistencias', function (Blueprint $table) {
            $table->id('idauditarAsistencias');
            $table->integer('idasistencias');
            $table->mediumText('observacion')->nullable();
            $table->string('estado',45);
            $table->integer('idAsistenciaSalidas');
            $table->integer('idAsistenciaEntradas');
            $table->string('fecha',100);
            $table->string('estadoAsistencia',100);
            $table->integer('idDocentes');
            $table->string('usuario',80);
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
        Schema::dropIfExists('auditarAsistencias');
    }
}
