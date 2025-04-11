<?php

namespace App\Filament\Clusters\GestaoAcademica\Resources\AvaliacaoResource\Pages;

use App\Filament\Clusters\GestaoAcademica\Resources\AvaliacaoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAvaliacaos extends ListRecords
{
    protected static string $resource = AvaliacaoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
