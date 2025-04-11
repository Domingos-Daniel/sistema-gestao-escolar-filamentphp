<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Action::make('gerar_boletim')
                ->label('Gerar Boletim')
                ->url(fn () => url('/boletim/' . $this->record->id))
                ->openUrlInNewTab(),
        ];
    }
}
