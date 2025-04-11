<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AtribuicaoDisciplina extends Model
{
    protected $fillable = ['professor_id', 'disciplina_id', 'turma_id'];

    public function professor()
    {
        return $this->belongsTo(User::class, 'professor_id');
    }

    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class);
    }

    public function turma()
    {
        return $this->belongsTo(Turma::class);
    }
}