<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog', function (Blueprint $table) {
            $table->bigIncrements('idblog');
            $table->bigInteger('idcategoriablog')->unsigned();
            $table->text('titulo');
            $table->text('subtitulo');
            $table->text('imagen'); 
            $table->text('contenido'); 
            $table->boolean('estado');
            $table->timestamps();

            $table->foreign('idcategoriablog')->references('idcategoriablog')->on('categoria_blog');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog');
    }
}
