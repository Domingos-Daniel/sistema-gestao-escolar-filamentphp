<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserDetailsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->date('data_nascimento')->nullable();
            $table->string('numero_estudante')->nullable();
            $table->string('especializacao')->nullable();
            $table->string('numero_funcionario')->nullable();
            $table->string('departamento')->nullable();
            $table->string('cargo')->nullable();
            $table->string('relacao')->nullable();
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'data_nascimento',
                'numero_estudante',
                'especializacao',
                'numero_funcionario',
                'departamento',
                'cargo',
                'relacao',
            ]);
        });
    }
}