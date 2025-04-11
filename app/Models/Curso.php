<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Curso extends Model
{
    protected $fillable = ['nome', 'nivel'];

    public function turmas()
    {
        return $this->hasMany(Turma::class);
    }

    public function disciplinas()
    {
        return $this->hasMany(Disciplina::class);
    }

    public function classes()
    {
        return $this->hasMany(Classe::class);
    }
}