<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCuestionarioPreguntaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cuestionario_pregunta', function (Blueprint $table) {
            $table->bigIncrements('id_cuestionariopregunta');
            $table->bigInteger('id_cuestionario')->unsigned()->required();
            $table->bigInteger('id_pregunta')->unsigned()->required();
            $table->integer('estado');
            $table->timestamps();

            $table->foreign('id_cuestionario')->references('id_cuestionario')->on('cuestionario');
            $table->foreign('id_pregunta')->references('id_pregunta')->on('pregunta');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cuestionario_pregunta');
    }
}
