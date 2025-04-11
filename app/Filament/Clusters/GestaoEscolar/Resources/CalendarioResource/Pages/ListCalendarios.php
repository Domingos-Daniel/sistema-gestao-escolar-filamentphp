<?php

namespace App\Filament\Clusters\GestaoEscolar\Resources\CalendarioResource\Pages;

use App\Filament\Clusters\GestaoEscolar\Resources\CalendarioResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCalendarios extends ListRecords
{
    protected static string $resource = CalendarioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
