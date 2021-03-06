<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecetasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recetas', function (Blueprint $table) {
            $table->id('id_receta');
            $table->integer('puntuacionTotal');
            $table->integer('cantidadVotos');
            $table->unsignedInteger('comida_id');       //Referencia a la ID de la comida
            $table->unsignedInteger('usuario_id');      //Referencia a la ID del usuario
            $table->string('usuario_nombre');
            $table->string('video');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recetas');
    }
}
