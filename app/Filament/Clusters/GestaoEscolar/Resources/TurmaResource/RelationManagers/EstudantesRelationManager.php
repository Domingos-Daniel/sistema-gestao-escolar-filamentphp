<?php

namespace App\Filament\Clusters\GestaoEscolar\Resources\TurmaResource\RelationManagers;

use Filament\Tables;
use Filament\Resources\RelationManagers\RelationManager;

class EstudantesRelationManager extends RelationManager
{
    protected static string $relationship = 'estudantes';

    public function table(Tables\Table $table): Tables\Table
{
    return $table
        ->recordTitleAttribute('name')
        ->columns([
            Tables\Columns\TextColumn::make('name')->label('Nome')->searchable(),
            Tables\Columns\TextColumn::make('numero_estudante')->label('Número do Estudante'),
            Tables\Columns\TextColumn::make('data_matricula')->label('Data da Matrícula')->date()
            ->getStateUsing(fn ($record) => $record->matriculas->first()?->data_matricula),
        ])
        ->filters([]);
}
}