<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvidenciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Evidencias', function (Blueprint $table) {
            $table->id('idEvidencias');
            $table->mediumText('docs');
            $table->integer('estado');
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
        Schema::dropIfExists('Evidencias');
    }
}
