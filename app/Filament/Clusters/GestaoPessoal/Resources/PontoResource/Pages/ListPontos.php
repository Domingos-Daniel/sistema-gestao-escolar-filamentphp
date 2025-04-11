<?php

namespace App\Filament\Clusters\GestaoPessoal\Resources\PontoResource\Pages;

use App\Filament\Clusters\GestaoPessoal\Resources\PontoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPontos extends ListRecords
{
    protected static string $resource = PontoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
