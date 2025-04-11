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
    Schema::table('matriculas', function (Blueprint $table) {
        $table->unsignedBigInteger('fee_structure_id')->nullable()->after('turma_id');
        $table->foreign('fee_structure_id')->references('id')->on('fee_structures');
    });
}

public function down()
{
    Schema::table('matriculas', function (Blueprint $table) {
        $table->dropForeign(['fee_structure_id']);
        $table->dropColumn('fee_structure_id');
    });
}
};
