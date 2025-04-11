<?php

namespace App\Filament\Clusters\GestaoPessoal\Resources\MensagemResource\Pages;

use App\Filament\Clusters\GestaoPessoal\Resources\MensagemResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMensagem extends CreateRecord
{
    protected static string $resource = MensagemResource::class;
}
