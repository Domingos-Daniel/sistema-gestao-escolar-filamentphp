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
    Schema::table('classes', function (Blueprint $table) {
        $table->unsignedBigInteger('curso_id')->nullable()->change(); // Torna o campo nullable
    });
}

public function down()
{
    Schema::table('classes', function (Blueprint $table) {
        $table->unsignedBigInteger('curso_id')->nullable(false)->change(); // Reverte para not null
    });
}
};
