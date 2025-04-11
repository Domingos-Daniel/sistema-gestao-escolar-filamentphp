<?php

namespace App\Filament\Clusters\GestaoPessoal\Resources\AtribuicaoDisciplinaResource\Pages;

use App\Filament\Clusters\GestaoPessoal\Resources\AtribuicaoDisciplinaResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAtribuicaoDisciplinas extends ListRecords
{
    protected static string $resource = AtribuicaoDisciplinaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
