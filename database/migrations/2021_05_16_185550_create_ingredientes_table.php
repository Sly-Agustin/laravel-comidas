<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIngredientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ingredientes', function (Blueprint $table) {
            $table->id('id_ingrediente');
            $table->string('nombre')->unique();
            $table->string('ubicacion')->nullable();
            $table->longText('descripcion')->nullable();
            $table->longText('caracteristicas')->nullable();
            $table->string('tipo')->nullable();
            $table->longText('imagen')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ingredientes');
    }
}
