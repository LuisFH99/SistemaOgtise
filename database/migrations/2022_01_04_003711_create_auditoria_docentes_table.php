<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditoriaDocentesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auditoriaDocentes', function (Blueprint $table) {
            $table->id();
            $table->integer('iddocente');
            $table->integer('idpersona');
            $table->string('clave',150);
            $table->string('categoria',100);
           $table->string('condicion',100);
           $table->string('dedicacion',100);
           $table->string('depacademico',250);
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
        Schema::dropIfExists('auditoriaDocentes');
    }
}
