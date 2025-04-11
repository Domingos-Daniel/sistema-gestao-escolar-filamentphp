<?php

namespace App\Filament\Clusters\GestaoEscolar\Resources\SalaResource\Pages;

use App\Filament\Clusters\GestaoEscolar\Resources\SalaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSala extends EditRecord
{
    protected static string $resource = SalaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
