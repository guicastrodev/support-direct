<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInteracoesTable extends Migration
{
    public function up()
    {
        Schema::create('interacoes', function (Blueprint $table) {
            $table->id();
            $table->text('descricao');
            $table->dateTime('datahora');
            $table->unsignedBigInteger('usuarioID');
            $table->foreign('usuarioID')->references('id')->on('usuarios');            
            $table->unsignedBigInteger('chamadoID');
            $table->foreign('chamadoID')->references('id')->on('chamados')->onDelete('cascade');            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('interacoes');
    }
}
