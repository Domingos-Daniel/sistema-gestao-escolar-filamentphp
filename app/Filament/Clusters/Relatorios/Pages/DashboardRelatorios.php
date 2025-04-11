<?php

namespace App\Filament\Clusters\Relatorios\Pages;

use App\Filament\Clusters\Relatorios;
use App\Filament\Widgets\MatriculasChart;
use App\Filament\Widgets\NotasChart;
use App\Filament\Widgets\PresencaChart;
use App\Filament\Widgets\PropinasChart;
use Filament\Pages\Dashboard as BaseDashboard;

class DashboardRelatorios extends BaseDashboard
{
    protected static string $routePath = '/dashboard';
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $navigationLabel = 'Dashboard de Relatórios';
    protected static ?string $cluster = Relatorios::class;
    protected static string $view = 'filament-panels::pages.dashboard';

    protected function getHeaderWidgets(): array
    {
        return [
            MatriculasChart::class,
            PropinasChart::class,
            NotasChart::class,
            PresencaChart::class,
        ];
    }

    public function getColumns(): int
    {
        return 1;
    }
}