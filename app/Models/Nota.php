<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $fillable = ['estudante_id', 'disciplina_id', 'avaliacao_id', 'nota', 'ano_letivo_id'];

    public function estudante()
    {
        return $this->belongsTo(User::class, 'estudante_id');
    }

    public function disciplina()
    {
        return $this->belongsTo(Disciplina::class);
    }

    public function avaliacao()
    {
        return $this->belongsTo(Avaliacao::class);
    }

    public function anoLetivo()
    {
        return $this->belongsTo(AnoLetivo::class);
    }
}