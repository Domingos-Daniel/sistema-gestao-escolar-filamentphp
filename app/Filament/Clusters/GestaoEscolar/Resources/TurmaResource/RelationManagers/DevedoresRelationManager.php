<?php

namespace App\Filament\Clusters\GestaoEscolar\Resources\TurmaResource\RelationManagers;

use Filament\Tables;
use Filament\Resources\RelationManagers\RelationManager;

class DevedoresRelationManager extends RelationManager
{
    protected static string $relationship = 'devedores';

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->recordTitleAttribute('name')
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Nome')
                    ->searchable(),
                Tables\Columns\TextColumn::make('numero_estudante')
                    ->label('Número do Estudante'),
                Tables\Columns\TextColumn::make('matriculas.propinas')
                    ->label('Total Devido')
                    ->getStateUsing(function ($record) {
                        return $record->matriculas->flatMap->propinas
                            ->where('pago', false)
                            ->where('vencimento', '<', now())
                            ->sum('valor');
                    }),
            ])
            ->filters([
                //
            ]);
    }
}