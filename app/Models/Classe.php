<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    protected $fillable = ['nome', 'curso_id', 'nivel'];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function turmas()
    {
        return $this->hasMany(Turma::class);
    }

    public function disciplinas()
    {
        return $this->hasMany(Disciplina::class);
    }
}