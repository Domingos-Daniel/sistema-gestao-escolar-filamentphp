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
            $table->decimal('valor_matricula', 8, 2)->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('matriculas', function (Blueprint $table) {
            $table->decimal('valor_matricula', 8, 2)->nullable(false)->change();
        });
    }
};
