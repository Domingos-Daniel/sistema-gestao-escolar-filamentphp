<?php

namespace App\Filament\Clusters\Relatorios\Pages;

use App\Filament\Clusters\Relatorios;
use App\Filament\Widgets\MatriculasChart;
use App\Filament\Widgets\NotasChart;
use App\Filament\Widgets\PresencaChart;
use App\Filament\Widgets\PropinasChart;
use Filament\Pages\Page;

class DashboardRelatorios extends Page
{

    protected static string $routePath = '/relatorios/dashboard'; // Caminho personalizado
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationLabel = 'Dashboard de Relatórios';

    // Associar ao cluster
    protected static ?string $cluster = Relatorios::class;

    protected function getHeaderWidgets(): array
    {
        return [
            MatriculasChart::class,
            PropinasChart::class,
            NotasChart::class,
            PresencaChart::class,
        ];
    }
}
