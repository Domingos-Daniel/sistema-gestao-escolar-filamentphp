<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ponto extends Model
{
    protected $fillable = ['user_id', 'entrada', 'saida'];

    protected $casts = [
        'entrada' => 'datetime',
        'saida' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}