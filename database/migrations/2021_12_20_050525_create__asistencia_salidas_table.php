<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsistenciaSalidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('AsistenciaSalidas', function (Blueprint $table) {
            $table->id('idAsistenciaSalidas');
            $table->time('hor_entrada');
            $table->mediumText('informe');
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
        Schema::dropIfExists('AsistenciaSalidas');
    }
}
