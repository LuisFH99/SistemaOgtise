 <?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepAcademicosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('DepAcademicos', function (Blueprint $table) {
            $table->id('idDepAcademicos');
            $table->string('nomdep',85);
            $table->string('correo',85);
            $table->unsignedBigInteger('fk_idFacultades');
            $table->foreign('fk_idFacultades')->references('id_Facultades')->on('Facultades');
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
        Schema::dropIfExists('DepAcademicos');
    }
}
