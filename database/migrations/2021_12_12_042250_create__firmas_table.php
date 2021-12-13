<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFirmasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Firmas', function (Blueprint $table) {
            $table->id('idFirmas');
            $table->mediumtext('firma');
            $table->string('token',45);
            $table->integer('estado');
            $table->unsignedBigInteger('fk_idTipFirmas');
            $table->foreign('fk_idTipFirmas')->references('idTipFirmas')->on('TipFirmas');
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
        Schema::dropIfExists('Firmas');
    }
}
