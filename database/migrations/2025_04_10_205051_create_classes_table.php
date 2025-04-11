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
    Schema::create('classes', function (Blueprint $table) {
        $table->id();
        $table->string('nome'); // Ex.: "Iniciação", "1ª Classe", "12ª Classe"
        $table->unsignedBigInteger('curso_id'); // Relaciona com o curso
        $table->integer('nivel'); // Ordem numérica: 0 para Iniciação, 1 para 1ª, etc.
        $table->timestamps();
        $table->foreign('curso_id')->references('id')->on('cursos');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classes');
    }
};
