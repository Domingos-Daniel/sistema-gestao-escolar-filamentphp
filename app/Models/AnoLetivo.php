<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class AnoLetivo extends Model
{
    protected $fillable = ['ano', 'data_inicio', 'data_fim'];
    protected $dates = ['data_inicio', 'data_fim']; // Converte automaticamente para Carbon
    protected $casts = [
        'ano' => 'integer',      // Define ano como inteiro
        'data_inicio' => 'date', // Define data_inicio como data
        'data_fim' => 'date',    // Define data_fim como data
    ];
    public function turmas()
    {
        return $this->hasMany(Turma::class);
    }

    public function calendarios()
    {
        return $this->hasMany(Calendario::class);
    }
}
