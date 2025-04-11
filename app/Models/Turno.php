<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Turno extends Model
{
    protected $fillable = ['nome', 'hora_inicio', 'hora_fim'];

    public function turmas()
    {
        return $this->hasMany(Turma::class);
    }
}
