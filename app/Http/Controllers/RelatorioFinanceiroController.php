<?php

namespace App\Http\Controllers;


use App\Models\Matricula;
use App\Models\Propina;
use App\Models\FeeStructure;
use Barryvdh\DomPDF\Facade\Pdf;

class RelatorioFinanceiroController extends Controller
{
    public function resumoAnual($ano_letivo_id)
    {
        $matriculas = Matricula::whereHas('turma', fn ($q) => $q->where('ano_letivo_id', $ano_letivo_id))
            ->with(['estudante', 'turma', 'propinas'])
            ->get();
        $totalMatriculas = $matriculas->sum('valor_matricula');
        $totalPropinasPagas = Propina::whereIn('matricula_id', $matriculas->pluck('id'))
            ->where('pago', true)
            ->sum('valor');
        $totalPropinasPendentes = Propina::whereIn('matricula_id', $matriculas->pluck('id'))
            ->where('pago', false)
            ->sum('valor');

        $pdf = Pdf::loadView('relatorios.resumo_anual', compact('matriculas', 'totalMatriculas', 'totalPropinasPagas', 'totalPropinasPendentes', 'ano_letivo_id'));
        return $pdf->download("resumo_financeiro_{$ano_letivo_id}.pdf");
    }
}