<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAsistenciaSalidaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('asistencia_salida', function (Blueprint $table) {
            $table->id();
            $table->time('Hora_salida');
            $table->mediumText('Informe');
            $table->mediumText('Firma');
            $table->mediumText('Evidencia');
            $table->integer('Estado');
            $table->string('CodigoSalida', 70);
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
        Schema::dropIfExists('asistencia_salida');
    }
}
