<?php

namespace App\Filament\Clusters\GestaoEscolar\Resources\TurnoResource\Pages;

use App\Filament\Clusters\GestaoEscolar\Resources\TurnoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTurno extends EditRecord
{
    protected static string $resource = TurnoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
