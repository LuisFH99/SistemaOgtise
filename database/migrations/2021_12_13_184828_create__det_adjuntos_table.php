<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetAdjuntosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DetAdjuntos', function (Blueprint $table) {
            $table->id('idDetAdjuntos');
            $table->integer('estado');
            $table->unsignedBigInteger('fk_idAdjuntos')->unique();
            $table->foreign('fk_idAdjuntos')->references('idAdjuntos')->on('Adjuntos');
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
        Schema::dropIfExists('DetAdjuntos');
    }
}
