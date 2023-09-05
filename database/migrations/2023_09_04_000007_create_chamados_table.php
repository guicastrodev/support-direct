<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChamadosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chamados', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->enum('status', ['Aberto','Em análise', 'Resolvido', 'Cancelado', 'Aguardando Requerente', 'Aguardando Fornecedor'])->default('Aberto');
            $table->unsignedBigInteger('requerenteID');
            $table->foreign('requerenteID')->references('id')->on('usuarios');
            $table->unsignedBigInteger('tecnicoID')->nullable();
            $table->foreign('tecnicoID')->references('id')->on('usuarios');
            $table->unsignedBigInteger('gestorID');
            $table->foreign('gestorID')->references('id')->on('usuarios');
            $table->unsignedBigInteger('categoriaID')->nullable();  
            $table->foreign('categoriaID')->references('id')->on('categorias');    
            $table->enum('prioridade', ['baixa', 'media', 'alta']);            
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
        Schema::dropIfExists('chamados');
    }
}
