<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditarAsistSalidasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditarAsistSalida', function (Blueprint $table) {
            $table->id('idauditarAsistSalida');
            $table->integer('idasistenciasalidas');
            $table->string('hor_salida',100);
            $table->mediumText('informe');
            $table->integer('idfirmas');
            $table->string('estado',45);
            $table->string('usuario',85);
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
        Schema::dropIfExists('auditarAsistSalida');
    }
}
