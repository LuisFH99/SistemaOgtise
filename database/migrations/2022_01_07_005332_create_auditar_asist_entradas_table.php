<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditarAsistEntradasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditarAsistEntradas', function (Blueprint $table) {
            $table->id('idauditarAsistEntradas');
            $table->integer('idasistenciaentradas');
            $table->string('hor_entrada',100);
            $table->string('url_foto');
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
        Schema::dropIfExists('auditarAsistEntradas');
    }
}
