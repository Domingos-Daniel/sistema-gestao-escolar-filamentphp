<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Disciplina extends Model
{
    protected $fillable = ['nome', 'curso_id', 'classe_id'];

    public function curso()
    {
        return $this->belongsTo(Curso::class);
    }

    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    
}