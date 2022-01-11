<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditoriaPersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditoriaPersonas', function (Blueprint $table) {
            $table->id('idauditoriaPersonas');
            $table->integer('idpersona');
            $table->string('persona',300);
            $table->string('dni',45);
           $table->string('telefono',45);
           $table->string('correo',150);
           $table->string('estado',45);
           $table->string('usuario',150);
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
        Schema::dropIfExists('auditoriaPersonas');
    }
}
