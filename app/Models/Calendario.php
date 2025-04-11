<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Calendario extends Model
{
    protected $fillable = ['ano_letivo_id', 'data', 'evento'];

    public function anoLetivo()
    {
        return $this->belongsTo(AnoLetivo::class);
    }
}
