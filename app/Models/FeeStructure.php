<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FeeStructure extends Model
{
    protected $fillable = ['ano_letivo_id', 'classe_id', 'curso_id', 'enrollment_fee', 'monthly_fee'];

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

    public function matriculas()
    {
        return $this->hasMany(Matricula::class);
    }
}