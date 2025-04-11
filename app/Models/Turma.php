<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Turma extends Model
{
    protected $fillable = ['nome', 'ano_letivo_id', 'classe_id', 'curso_id', 'turno_id', 'sala_id'];

    public function anoLetivo()
    {
        return $this->belongsTo(AnoLetivo::class);
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function turno()
    {
        return $this->belongsTo(Turno::class);
    }

    public function sala()
    {
        return $this->belongsTo(Sala::class);
    }

    public function matriculas()
    {
        return $this->hasMany(Matricula::class);
    }

    public function estudantes()
    {
        return $this->hasManyThrough(User::class, Matricula::class, 'turma_id', 'id', 'id', 'estudante_id');
    }


    public function devedores()
    {
        return $this->estudantes()->whereHas('matriculas.propinas', function ($query) {
            $query->where('pago', false)->where('vencimento', '<', now());
        })->distinct();
    }
}