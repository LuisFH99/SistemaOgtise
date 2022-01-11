<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditAdministrativosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditAdministrativos', function (Blueprint $table) {
            $table->id('idauditAdministrativos');
            $table->integer('idadministrativos');
            $table->string('clave',45);
            $table->string('estado',45);
            $table->integer('idpersonas');
            $table->string('rol',60);
            $table->timestamps();
            $table->string('usuario',45);
            $table->string('accion',45);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auditAdministrativos');
    }
}
