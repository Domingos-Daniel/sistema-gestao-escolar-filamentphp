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
    Schema::create('turmas', function (Blueprint $table) {
        $table->id();
        $table->string('nome');
        $table->unsignedBigInteger('ano_letivo_id');
        $table->unsignedBigInteger('curso_id');
        $table->unsignedBigInteger('turno_id');
        $table->unsignedBigInteger('sala_id')->nullable();
        $table->timestamps();
        $table->foreign('ano_letivo_id')->references('id')->on('ano_letivos');
        $table->foreign('curso_id')->references('id')->on('cursos');
        $table->foreign('turno_id')->references('id')->on('turnos');
        $table->foreign('sala_id')->references('id')->on('salas');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('turmas');
    }
};
