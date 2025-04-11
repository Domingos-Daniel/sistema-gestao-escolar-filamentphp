<?php

namespace App\Filament\Clusters\GestaoEscolar\Resources\TurnoResource\Pages;

use App\Filament\Clusters\GestaoEscolar\Resources\TurnoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTurnos extends ListRecords
{
    protected static string $resource = TurnoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
