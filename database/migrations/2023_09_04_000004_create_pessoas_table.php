<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePessoasTable extends Migration
{
    public function up()
    {
        Schema::create('pessoas', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('empresa')->nullable();
            $table->string('endereco')->nullable();
            $table->string('telefone')->nullable();
            $table->string('cpfcnpj')->nullable();
            $table->string('especialidade')->nullable();
            $table->string('disponibilidade')->nullable();
            $table->unsignedBigInteger('departamentoID')->nullable();  
            $table->foreign('departamentoID')->references('id')->on('departamentos');                  
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pessoas');
    }
}
