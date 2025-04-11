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
    Schema::table('disciplinas', function (Blueprint $table) {
        $table->unsignedBigInteger('curso_id')->nullable()->change(); // Torna curso_id opcional
        $table->unsignedBigInteger('classe_id')->nullable()->after('nome'); // Adiciona classe_id
        $table->foreign('classe_id')->references('id')->on('classes');
    });
}

public function down()
{
    Schema::table('disciplinas', function (Blueprint $table) {
        $table->unsignedBigInteger('curso_id')->nullable(false)->change(); // Reverte curso_id
        $table->dropForeign(['classe_id']);
        $table->dropColumn('classe_id');
    });
}
};
