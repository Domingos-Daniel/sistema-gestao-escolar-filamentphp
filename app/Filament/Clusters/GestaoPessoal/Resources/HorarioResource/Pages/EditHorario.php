<?php

namespace App\Filament\Clusters\GestaoPessoal\Resources\HorarioResource\Pages;

use App\Filament\Clusters\GestaoPessoal\Resources\HorarioResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHorario extends EditRecord
{
    protected static string $resource = HorarioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
