<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateChamadosTable extends Migration
{
    public function up()
    {
        Schema::table('chamados', function (Blueprint $table) {
            $table->unsignedBigInteger('requerenteID');
            $table->unsignedBigInteger('tecnicoID')->nullable();
            $table->unsignedBigInteger('gestorID');
            $table->string('categoria');
            $table->enum('prioridade', ['baixa', 'media', 'alta']);
        });
    }

    public function down()
    {
        Schema::table('chamados', function (Blueprint $table) {
            $table->dropColumn(['requerenteID', 'tecnicoID', 'gestorID', 'categoria', 'prioridade']);
        });
    }
}
