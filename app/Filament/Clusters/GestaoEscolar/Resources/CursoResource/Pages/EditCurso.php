<?php

namespace App\Filament\Clusters\GestaoEscolar\Resources\CursoResource\Pages;

use App\Filament\Clusters\GestaoEscolar\Resources\CursoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCurso extends EditRecord
{
    protected static string $resource = CursoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
