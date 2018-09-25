<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaRespuestas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Tbl_Respuestas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Descripcion');
            $table->integer('Puntaje');
            $table->integer('Pregunta_id')->unsigned();
            $table->foreign("Pregunta_id")->references('id')->on('Tbl_Preguntas');
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
        Schema::dropIfExists('Tbl_Respuestas');
    }
}
