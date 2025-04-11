<?php

namespace App\Filament\Clusters\GestaoAcademica\Resources\NotaResource\Pages;

use App\Filament\Clusters\GestaoAcademica\Resources\NotaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNota extends EditRecord
{
    protected static string $resource = NotaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
