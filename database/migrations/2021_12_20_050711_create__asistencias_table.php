<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsistenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Asistencias', function (Blueprint $table) {
            $table->id('idAsistencias');
            $table->mediumText('observacion')->nullable();;
            $table->string('estado');
            $table->unsignedBigInteger('fk_idAsistenciaSalidas')->unique();
            $table->foreign('fk_idAsistenciaSalidas')->references('idAsistenciaSalidas')->on('AsistenciaSalidas');
            $table->unsignedBigInteger('fk_idAsistenciaEntradas')->unique();
            $table->foreign('fk_idAsistenciaEntradas')->references('idAsistenciaEntradas')->on('AsistenciaEntradas');
            $table->unsignedBigInteger('fk_idFechAsistencias');
            $table->foreign('fk_idFechAsistencias')->references('idFechAsistencias')->on('FechAsistencias');
            $table->unsignedBigInteger('fk_idEstadoAsistencias');
            $table->foreign('fk_idEstadoAsistencias')->references('idEstadoAsistencias')->on('EstadoAsistencias');
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
        Schema::dropIfExists('Asistencias');
    }
}
