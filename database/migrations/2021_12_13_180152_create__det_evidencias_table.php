<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetEvidenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DetEvidencias', function (Blueprint $table) {
            $table->id('DetEvidencias');
            $table->integer('estado');
            $table->unsignedBigInteger('fk_idEvidencias')->unique();
            $table->foreign('fk_idEvidencias')->references('idEvidencias')->on('Evidencias');
            $table->unsignedBigInteger('fk_idAsistenciaSalidas');
            $table->foreign('fk_idAsistenciaSalidas')->references('idAsistenciaSalidas')->on('AsistenciaSalidas');
           
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
        Schema::dropIfExists('DetEvidencias');
    }
}
