<?php

namespace App\Filament\Clusters\GestaoEscolar\Resources\CalendarioResource\Pages;

use App\Filament\Clusters\GestaoEscolar\Resources\CalendarioResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCalendario extends EditRecord
{
    protected static string $resource = CalendarioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
