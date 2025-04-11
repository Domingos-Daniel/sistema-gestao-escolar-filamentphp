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
    Schema::create('mensagens', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('remetente_id');
        $table->unsignedBigInteger('destinatario_id');
        $table->text('conteudo');
        $table->boolean('lida')->default(false);
        $table->timestamps();
        $table->foreign('remetente_id')->references('id')->on('users');
        $table->foreign('destinatario_id')->references('id')->on('users');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mensagens');
    }
};
