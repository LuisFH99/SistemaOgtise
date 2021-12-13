<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Docentes', function (Blueprint $table) {
            $table->id('idDocentes');
            $table->string('clave',40);
            $table->integer('estado');
            $table->unsignedBigInteger('fk_idPersonas')->unique();
            $table->foreign('fk_idPersonas')->references('idPersonas')->on('Personas');
            $table->unsignedBigInteger('fk_idCategorias');
            $table->foreign('fk_idCategorias')->references('idCategorias')->on('Categorias');
            $table->unsignedBigInteger('fk_idCondiciones');
            $table->foreign('fk_idCondiciones')->references('idCondiciones')->on('Condiciones');
            $table->unsignedBigInteger('fk_idDedicaciones');
            $table->foreign('fk_idDedicaciones')->references('idDedicaciones')->on('Dedicaciones');
            $table->unsignedBigInteger('fk_idDepAcademicos');
            $table->foreign('fk_idDepAcademicos')->references('idDepAcademicos')->on('DepAcademicos');
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
        Schema::dropIfExists('Docentes');
    }
}
