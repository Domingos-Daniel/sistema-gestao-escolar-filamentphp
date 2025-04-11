<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Propina extends Model
{
    protected $table = 'propinas';

    protected $fillable = ['matricula_id', 'valor', 'vencimento', 'pago', 'data_pagamento'];

    protected $casts = [
        'vencimento' => 'date',
        'data_pagamento' => 'date',
        'pago' => 'boolean',
    ];

    public function matricula()
    {
        return $this->belongsTo(Matricula::class);
    }
}