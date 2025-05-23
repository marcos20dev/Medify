<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNoticiasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('noticias', function (Blueprint $table) {
            $table->id();
            $table->string('titulo', 200);
            $table->longText('descripcion');
            $table->longText('foto')->nullable();

            $table->unsignedBigInteger('comentarios')->default(0);
            $table->unsignedBigInteger('vistas')->default(0);
            $table->unsignedBigInteger('compartidos')->default(0);
            $table->boolean('publicada')->default(false);
            $table->string('categoria')->nullable();
            $table->text('etiquetas')->nullable();

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
        Schema::dropIfExists('noticias');
    }
}
