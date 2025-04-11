<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Avaliacao extends Model
{
    protected $table = 'avaliacoes'; // Define explicitamente o nome da tabela
    protected $fillable = ['disciplina_id', 'turma_id', 'nome', 'data', 'peso'];

    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class);
    }

    public function turma()
    {
        return $this->belongsTo(Turma::class);
    }

    public function notas()
    {
        return $this->hasMany(Nota::class);
    }
}
