<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditAdjuntosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditAdjuntos', function (Blueprint $table) {
            $table->id('idauditAdjuntos');
            $table->integer('idadjuntos');
            $table->mediumText('docs');
            $table->string('estado',45);
            $table->integer('idSolicitudes');
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
        Schema::dropIfExists('auditAdjuntos');
    }
}
