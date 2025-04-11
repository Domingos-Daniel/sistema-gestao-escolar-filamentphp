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
    Schema::table('turmas', function (Blueprint $table) {
        $table->unsignedBigInteger('classe_id')->nullable()->after('nome');
        $table->foreign('classe_id')->references('id')->on('classes');
    });
}

public function down()
{
    Schema::table('turmas', function (Blueprint $table) {
        $table->dropForeign(['classe_id']);
        $table->dropColumn('classe_id');
    });
}
};
