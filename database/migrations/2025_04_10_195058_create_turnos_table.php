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
    Schema::create('turnos', function (Blueprint $table) {
        $table->id();
        $table->string('nome'); // Ex.: Manhã, Tarde, Noite
        $table->time('hora_inicio');
        $table->time('hora_fim');
        $table->timestamps();
    });
}
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('turnos');
    }
};
