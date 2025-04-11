<?php

namespace App\Filament\Widgets;

use App\Models\Nota;
use Filament\Widgets\ChartWidget;

class NotasChart extends ChartWidget
{
    protected static ?string $heading = 'Distribuição de Notas';
    protected static ?string $maxHeight = '300px';

    protected function getType(): string
    {
        return 'pie';
    }

    protected function getData(): array
    {
        $notas = Nota::all();
        $faixas = [
            '0-5' => $notas->whereBetween('valor', [0, 5])->count(),
            '6-10' => $notas->whereBetween('valor', [6, 10])->count(),
            '11-15' => $notas->whereBetween('valor', [11, 15])->count(),
            '16-20' => $notas->whereBetween('valor', [16, 20])->count(),
        ];

        return [
            'datasets' => [
                [
                    'data' => array_values($faixas),
                    'backgroundColor' => ['#FF6384', '#36A2EB', '#FFCE56', '#4CAF50'],
                ],
            ],
            'labels' => array_keys($faixas),
        ];
    }
}