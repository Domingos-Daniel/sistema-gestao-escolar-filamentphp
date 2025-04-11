<?php

namespace App\Filament\Clusters\GestaoEscolar\Resources\DisciplinaResource\Pages;

use App\Filament\Clusters\GestaoEscolar\Resources\DisciplinaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDisciplinas extends ListRecords
{
    protected static string $resource = DisciplinaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
