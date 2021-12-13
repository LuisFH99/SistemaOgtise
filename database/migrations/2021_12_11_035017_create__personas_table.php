<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Personas', function (Blueprint $table) {
            $table->id('idPersonas');
            $table->string('DNI',8);
            $table->string('nombres',100);
            $table->string('apellPat',80);
            $table->string('apellMat',80);
            $table->date('fechNacimiento');
            $table->string('correo',80);
            $table->string('telefono',15);
            $table->integer('estado');
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
        Schema::dropIfExists('Personas');
    }
}
