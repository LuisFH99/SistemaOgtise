<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditoriafirmahassolicitudesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditoriafirmahassolicitudes', function (Blueprint $table) {
            $table->id('idauditoriafirmahassolicitudes');
            $table->integer('idFirmaHasSolicitudes');
            $table->string('fechaFirma',150);
            $table->integer('idFirmas');
            $table->integer('idSolicitude');
            $table->integer('idPersonas');
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
        Schema::dropIfExists('auditoriafirmahassolicitudes');
    }
}
