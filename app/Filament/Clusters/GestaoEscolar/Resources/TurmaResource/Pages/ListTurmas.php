<?php

namespace App\Filament\Clusters\GestaoEscolar\Resources\TurmaResource\Pages;

use App\Filament\Clusters\GestaoEscolar\Resources\TurmaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTurmas extends ListRecords
{
    protected static string $resource = TurmaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
