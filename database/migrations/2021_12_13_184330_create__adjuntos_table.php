<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdjuntosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Adjuntos', function (Blueprint $table) {
            $table->id('idAdjuntos');
            $table->mediumText('docs');
            $table->integer('estado');
            $table->unsignedBigInteger('fk_idSolicitudes');
            $table->foreign('fk_idSolicitudes')->references('idSolicitudes')->on('Solicitudes');
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
        Schema::dropIfExists('Adjuntos');
    }
}
