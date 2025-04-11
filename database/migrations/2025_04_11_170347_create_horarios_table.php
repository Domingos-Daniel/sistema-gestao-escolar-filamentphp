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
    Schema::create('horarios', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('turma_id')->nullable(); // Opcional para professores
        $table->time('hora_inicio');
        $table->time('hora_fim');
        $table->string('dia_semana'); // ex.: Segunda, Terça
        $table->timestamps();
        $table->foreign('user_id')->references('id')->on('users');
        $table->foreign('turma_id')->references('id')->on('turmas');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('horarios');
    }
};
