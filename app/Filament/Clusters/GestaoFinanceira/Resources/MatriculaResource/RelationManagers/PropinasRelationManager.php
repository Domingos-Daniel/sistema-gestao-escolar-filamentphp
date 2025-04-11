<?php

namespace App\Filament\Clusters\GestaoFinanceira\Resources\MatriculaResource\RelationManagers;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\RelationManagers\RelationManager;

class PropinasRelationManager extends RelationManager
{
    protected static string $relationship = 'propinas';

    public function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('valor')
                    ->numeric()
                    ->required()
                    ->label('Valor'),
                Forms\Components\DatePicker::make('vencimento')
                    ->required()
                    ->label('Vencimento'),
                Forms\Components\Toggle::make('pago')
                    ->label('Pago'),
                Forms\Components\DatePicker::make('data_pagamento')
                    ->label('Data do Pagamento')
                    ->visible(fn ($get) => $get('pago')),
            ]);
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('valor')->label('Valor'),
                Tables\Columns\TextColumn::make('vencimento')->label('Vencimento'),
                Tables\Columns\TextColumn::make('pago')->label('Pago')
                ->getStateUsing(fn ($record) => $record->pago ? 'Sim' : 'Não'),
                Tables\Columns\TextColumn::make('data_pagamento')->label('Data do Pagamento')
                    ->getStateUsing(fn ($record) => $record->pago ? $record->data_pagamento : 'N/A'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}