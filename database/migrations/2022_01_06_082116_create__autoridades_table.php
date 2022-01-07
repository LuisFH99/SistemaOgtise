<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAutoridadesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Autoridades', function (Blueprint $table) {
            $table->id('idAutoridades');
            $table->unsignedBigInteger('fk_idDocentes');
            $table->foreign('fk_idDocentes')->references('idDocentes')->on('Docentes');
            $table->unsignedBigInteger('fk_idCargos');
            $table->foreign('fk_idCargos')->references('idCargos')->on('cargos');
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
        Schema::dropIfExists('Autoridades');
    }
}
