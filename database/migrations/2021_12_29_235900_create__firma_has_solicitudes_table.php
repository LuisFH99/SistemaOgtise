<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFirmaHasSolicitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('FirmaHasSolicitudes', function (Blueprint $table) {
            $table->id('idFirmaHasSolicitudes');
            $table->unsignedBigInteger('fk_idFirmas');
            $table->foreign('fk_idFirmas')->references('idFirmas')->on('Firmas');
            $table->unsignedBigInteger('fk_idsolicitudes');
            $table->foreign('fk_idsolicitudes')->references('idSolicitudes')->on('Solicitudes');
            $table->unsignedBigInteger('fk_idPersonas');
            $table->foreign('fk_idPersonas')->references('idPersonas')->on('Personas');
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
        Schema::dropIfExists('FirmaHasSolicitudes');
    }
}
