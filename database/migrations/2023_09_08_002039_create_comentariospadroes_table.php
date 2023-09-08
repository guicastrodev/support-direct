<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComentariospadroesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comentariospadroes', function (Blueprint $table) {
            $table->id();
            $table->string('mensagem');
            $table->unsignedBigInteger('usuarioID');  
            $table->foreign('usuarioID')->references('id')->on('usuarios');                
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
        Schema::dropIfExists('comentariospadroes');
    }
}
