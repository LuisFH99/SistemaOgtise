<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditarEvienciasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditarEviencias', function (Blueprint $table) {
            $table->id('idauditarEviencias');
            $table->integer('idevidencias');
            $table->mediumText('docs');
            $table->string('estado',45);
            $table->integer('idAsistenciaSalidas');
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
        Schema::dropIfExists('auditarEviencias');
    }
}
