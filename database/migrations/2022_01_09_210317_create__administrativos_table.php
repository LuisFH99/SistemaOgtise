<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdministrativosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Administrativos', function (Blueprint $table) {
            $table->id('idAdministrativos');
            $table->string('clave',45);
            $table->integer('estado');
            $table->unsignedBigInteger('fk_idPersonas')->unique();
            $table->foreign('fk_idPersonas')->references('idPersonas')->on('Personas');
            $table->unsignedBigInteger('fk_idRoles');
            $table->foreign('fk_idRoles')->references('id')->on('roles');
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
        Schema::dropIfExists('Administrativos');
    }
}
