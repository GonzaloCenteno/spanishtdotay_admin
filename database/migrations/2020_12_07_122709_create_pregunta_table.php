<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreguntaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pregunta', function (Blueprint $table) {
            $table->bigIncrements('id_pregunta');
            $table->text('pregunta');
            $table->text('detalle')->nullable();
            $table->date('fecha_creacion');
            $table->decimal('calificacion');
            $table->enum('tipo',[1,2]);
            $table->integer('cantidadCorrectas');
            $table->decimal('calificacionRespuesta');
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
        Schema::dropIfExists('pregunta');
    }
}
