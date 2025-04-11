<?php

namespace App\Filament\Clusters;

use App\Filament\Clusters\Relatorios\Pages\DashboardRelatorios;
use Filament\Clusters\Cluster;

class Relatorios extends Cluster
{
    protected static ?string $navigationLabel = 'Relatórios';
    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';

    public static function getPages(): array
    {
        return [
            'dashboard' => DashboardRelatorios::route('/dashboard'),
        ];
    }
}
