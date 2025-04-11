<?php

namespace App\Filament\Clusters\GestaoFinanceira\Resources\PropinaResource\Pages;

use App\Filament\Clusters\GestaoFinanceira\Resources\PropinaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPropinas extends ListRecords
{
    protected static string $resource = PropinaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
