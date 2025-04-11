<?php

namespace App\Filament\Resources\UserResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NotasRelationManager extends RelationManager
{
    protected static string $relationship = 'notas';

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->recordTitleAttribute('nota')
            ->columns([
                Tables\Columns\TextColumn::make('disciplina.nome')->label('Disciplina'),
                Tables\Columns\TextColumn::make('avaliacao.nome')->label('Avaliação')->default('N/A'),
                Tables\Columns\TextColumn::make('nota')->label('Nota'),
                Tables\Columns\TextColumn::make('anoLetivo.ano')->label('Ano Letivo'),
            ]);
    }
}
