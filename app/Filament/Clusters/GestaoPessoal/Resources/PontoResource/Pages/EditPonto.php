<?php

namespace App\Filament\Clusters\GestaoPessoal\Resources\PontoResource\Pages;

use App\Filament\Clusters\GestaoPessoal\Resources\PontoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPonto extends EditRecord
{
    protected static string $resource = PontoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
