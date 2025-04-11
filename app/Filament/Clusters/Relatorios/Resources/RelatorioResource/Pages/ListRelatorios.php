<?php

namespace App\Filament\Clusters\Relatorios\Resources\RelatorioResource\Pages;

use App\Filament\Clusters\Relatorios\Resources\RelatorioResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListRelatorios extends ListRecords
{
    protected static string $resource = RelatorioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
