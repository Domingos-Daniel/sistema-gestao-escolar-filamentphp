<?php

namespace App\Filament\Clusters\GestaoEscolar\Resources\ClasseResource\Pages;

use App\Filament\Clusters\GestaoEscolar\Resources\ClasseResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListClasses extends ListRecords
{
    protected static string $resource = ClasseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
