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
    Schema::create('avaliacoes', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('disciplina_id');
        $table->unsignedBigInteger('turma_id');
        $table->string('nome');
        $table->date('data');
        $table->decimal('peso', 5, 2)->default(1);
        $table->timestamps();
        $table->foreign('disciplina_id')->references('id')->on('disciplinas');
        $table->foreign('turma_id')->references('id')->on('turmas');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('avaliacaos');
    }
};
