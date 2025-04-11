<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('atribuicao_disciplinas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('professor_id');
            $table->unsignedBigInteger('disciplina_id');
            $table->unsignedBigInteger('turma_id');
            $table->timestamps();
            $table->foreign('professor_id')->references('id')->on('users');
            $table->foreign('disciplina_id')->references('id')->on('disciplinas');
            $table->foreign('turma_id')->references('id')->on('turmas');
            // Nome curto para a chave única
            $table->unique(['professor_id', 'disciplina_id', 'turma_id'], 'atribuicao_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atribuicao_disciplinas');
    }
};
