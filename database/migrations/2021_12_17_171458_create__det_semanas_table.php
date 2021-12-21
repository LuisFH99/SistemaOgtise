<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetSemanasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DetSemanas', function (Blueprint $table) {
            $table->id('idDetSemanas');
            $table->unsignedBigInteger('fk_idDocentes');
            $table->foreign('fk_idDocentes')->references('idDocentes')->on('Docentes');
            $table->unsignedBigInteger('fk_idSemanas');
            $table->foreign('fk_idSemanas')->references('idSemanas')->on('Semanas');
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
        Schema::dropIfExists('DetSemanas');
    }
}
