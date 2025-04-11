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
    Schema::create('notas', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('estudante_id');
        $table->unsignedBigInteger('disciplina_id');
        $table->unsignedBigInteger('avaliacao_id')->nullable();
        $table->decimal('nota', 5, 2);
        $table->unsignedBigInteger('ano_letivo_id');
        $table->timestamps();
        $table->foreign('estudante_id')->references('id')->on('users');
        $table->foreign('disciplina_id')->references('id')->on('disciplinas');
        $table->foreign('avaliacao_id')->references('id')->on('avaliacoes');
        $table->foreign('ano_letivo_id')->references('id')->on('ano_letivos');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notas');
    }
};
