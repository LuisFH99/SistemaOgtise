<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditoriaFirmasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditoriaFirmas', function (Blueprint $table) {
            $table->id();
            $table->integer('idfirma');
            $table->mediumtext('firma');
            $table->string('token',45);
            $table->string('tipo',45);
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
        Schema::dropIfExists('auditoriaFirmas');
    }
}
