<?php

namespace App\Filament\Clusters\GestaoFinanceira\Resources\MatriculaResource\Pages;

use App\Filament\Clusters\GestaoFinanceira\Resources\MatriculaResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMatricula extends CreateRecord
{
    protected static string $resource = MatriculaResource::class;
}
