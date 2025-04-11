<?php

namespace App\Filament\Clusters\GestaoEscolar\Resources\SalaResource\Pages;

use App\Filament\Clusters\GestaoEscolar\Resources\SalaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSalas extends ListRecords
{
    protected static string $resource = SalaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
