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
            $table->unsignedBigInteger('curso_id')->nullable()->change(); // Torna curso_id opcional
        });
    }

    public function down()
    {
        Schema::table('turmas', function (Blueprint $table) {
            $table->unsignedBigInteger('curso_id')->nullable(false)->change(); // Reverte para NOT NULL
        });
    }
};
