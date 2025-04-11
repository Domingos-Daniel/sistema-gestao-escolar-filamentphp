<?php

namespace App\Filament\Widgets;


use App\Models\Propina;
use Filament\Widgets\ChartWidget;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;

class PropinasChart extends ChartWidget
{
    protected static ?string $heading = 'Propinas Pagas por Mês';
    protected static ?string $maxHeight = '300px';

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getData(): array
    {
        $data = Trend::query(Propina::query()->where('pago', true))
            ->between(
                start: now()->startOfYear(),
                end: now()->endOfYear(),
            )
            ->perMonth()
            ->sum('valor');

        return [
            'datasets' => [
                [
                    'label' => 'Propinas Pagas',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                    'backgroundColor' => '#4CAF50',
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date),
        ];
    }
}