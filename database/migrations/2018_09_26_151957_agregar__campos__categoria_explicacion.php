<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregarCamposCategoriaExplicacion extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('Tbl_Preguntas', function (Blueprint $table) {
            $table->string('Explicacion');
            $table->integer('Categoria_id')->unsigned();
            $table->foreign("Categoria_id")->references('id')->on('Tbl_Categorias');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('Tbl_Preguntas', function (Blueprint $table) {
            //
        });
    }
}
