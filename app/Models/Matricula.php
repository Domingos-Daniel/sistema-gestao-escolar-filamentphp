<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Matricula extends Model
{
    protected $fillable = ['estudante_id', 'turma_id', 'fee_structure_id', 'data_matricula', 'valor_matricula', 'status'];

    protected static function booted()
    {
        static::created(function ($matricula) {
            $turma = $matricula->turma;
            $anoLetivo = $turma->anoLetivo;
            $feeStructure = $matricula->feeStructure;

            // Tentar obter uma data válida de data_inicio
            try {
                $dataInicioRaw = explode(',', $anoLetivo->data_inicio)[0];
                $dataInicio = Carbon::parse(trim($dataInicioRaw));
                $vencimento = $dataInicio->copy()->addMonth();
            } catch (\Exception $e) {
                // Fallback baseado no ano letivo
                $vencimento = Carbon::create($anoLetivo->ano, 1, 1)->addMonth();
            }

            // Verificar se a propina já existe para evitar duplicatas ao carregar relações
            if (!$matricula->propinas()->where('vencimento', $vencimento)->exists()) {
                Propina::create([
                    'matricula_id' => $matricula->id,
                    'valor' => $feeStructure->monthly_fee,
                    'vencimento' => $vencimento,
                    'pago' => false,
                ]);
            }
        });
    }

    public function estudante()
    {
        return $this->belongsTo(User::class, 'estudante_id');
    }

    public function turma()
    {
        return $this->belongsTo(Turma::class);
    }

    public function feeStructure()
    {
        return $this->belongsTo(FeeStructure::class);
    }

    public function propinas()
    {
        return $this->hasMany(Propina::class);
    }
}
