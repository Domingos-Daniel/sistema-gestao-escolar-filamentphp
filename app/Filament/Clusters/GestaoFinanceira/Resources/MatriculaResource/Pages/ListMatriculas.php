<?php

namespace App\Filament\Clusters\GestaoFinanceira\Resources\MatriculaResource\Pages;

use App\Filament\Clusters\GestaoFinanceira\Resources\MatriculaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMatriculas extends ListRecords
{
    protected static string $resource = MatriculaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
