<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrearTablaRespuestasXUsuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Tbl_Respuestas_UsuariosXEncuestas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('Respuesta_id')->unsigned();
            $table->foreign("Respuesta_id")->references('id')->on('Tbl_Respuestas');
            $table->integer('user_id')->unsigned();
            $table->foreign("user_id")->references('id')->on('users');
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
        Schema::dropIfExists('Tbl_Respuestas_UsuariosXEncuestas');
    }
}
