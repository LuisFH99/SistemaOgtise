<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsistenciaEntradasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('AsistenciaEntradas', function (Blueprint $table) {
            $table->id('idAsistenciaEntradas');
            $table->time('hor_entrada');
            $table->string('URL_foto',200);
            $table->string('estado');
            $table->unsignedBigInteger('fk_idFirmas')->unique();
            $table->foreign('fk_idFirmas')->references('idFirmas')->on('Firmas');
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
        Schema::dropIfExists('AsistenciaEntradas');
    }
}
