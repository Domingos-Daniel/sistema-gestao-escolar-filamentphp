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
        Schema::create('fee_structures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ano_letivo_id');
            $table->unsignedBigInteger('classe_id');
            $table->unsignedBigInteger('curso_id')->nullable();
            $table->decimal('enrollment_fee', 8, 2);
            $table->decimal('monthly_fee', 8, 2);
            $table->timestamps();
            $table->foreign('ano_letivo_id')->references('id')->on('ano_letivos');
            $table->foreign('classe_id')->references('id')->on('classes');
            $table->foreign('curso_id')->references('id')->on('cursos');
            $table->unique(['ano_letivo_id', 'classe_id', 'curso_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_structures');
    }
};
