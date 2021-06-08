<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeUtilizaEnsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('se_utiliza_ens', function (Blueprint $table) {
            $table->id('id_utilizaen');
            $table->string('cantidad');
            $table->unsignedInteger('receta_id');       //Referencia a la ID de la receta
            $table->unsignedInteger('ingrediente_id');  //Referencia a la ID del ingrediente
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('se_utiliza_ens');
    }
}
