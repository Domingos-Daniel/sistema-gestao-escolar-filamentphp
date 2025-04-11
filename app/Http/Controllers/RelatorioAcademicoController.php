<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Nota;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Collection;

class RelatorioAcademicoController extends Controller
{
    public function boletim($estudante_id)
    {
        $estudante = User::with(['turma.classe', 'turma.curso', 'turma.turno', 'turma.sala'])->findOrFail($estudante_id);
        $notas = Nota::where('estudante_id', $estudante_id)
            ->with(['disciplina', 'anoLetivo', 'avaliacao'])
            ->get();

        // Organize notas by disciplina and anoLetivo
        $disciplinas = $notas->groupBy('disciplina.nome');

        $pdf = Pdf::loadView('boletim', compact('estudante', 'disciplinas'));
        return $pdf->download('boletim_' . $estudante->name . '.pdf');
    }
}