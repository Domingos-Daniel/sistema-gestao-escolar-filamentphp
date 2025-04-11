<?php

namespace App\Filament\Clusters\GestaoFinanceira\Resources;

use App\Filament\Clusters\GestaoFinanceira;
use App\Filament\Clusters\GestaoFinanceira\Resources\PropinaResource\Pages;
use App\Filament\Clusters\GestaoFinanceira\Resources\PropinaResource\RelationManagers;
use App\Models\Propina;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Actions\Action;

class PropinaResource extends Resource
{
    protected static ?string $model = Propina::class;
    protected static ?string $cluster = GestaoFinanceira::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';
    protected static ?string $navigationLabel = 'Propinas';
    protected static ?string $label = 'Propina';
    protected static ?string $pluralLabel = 'Propinas';
    protected static ?string $slug = 'gestao-financeira/propinas';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('matricula_id')
                    ->relationship('matricula', 'id', fn ($query) => $query->with('estudante'))
                    ->getOptionLabelFromRecordUsing(fn ($record) => "Matrícula de {$record->estudante->name} - {$record->turma->nome}")
                    ->required()
                    ->label('Matrícula'),
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

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('matricula.estudante.name')
                    ->label('Estudante')
                    ->searchable(),
                Tables\Columns\TextColumn::make('matricula.turma.nome')
                    ->label('Turma'),
                Tables\Columns\TextColumn::make('valor')
                    ->label('Valor'),
                Tables\Columns\TextColumn::make('vencimento')
                    ->label('Vencimento')
                    ->date(),
                Tables\Columns\IconColumn::make('pago')
                    ->label('Pago')
                    ->getStateUsing(fn ($record) => $record->pago ? 'Nao' : 'Sim'),
                Tables\Columns\TextColumn::make('data_pagamento')
                    ->label('Data Pagamento')
                    ->date(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('pago')
                    ->label('Status')
                    ->options([
                        '1' => 'Pagas',
                        '0' => 'Não Pagas',
                    ]),
                Tables\Filters\Filter::make('vencidas')
                    ->label('Vencidas')
                    ->query(fn ($query) => $query->where('vencimento', '<', now())->where('pago', false)),
            ])
            ->actions([
                Action::make('pagar')
                    ->label('Marcar como Pago')
                    ->icon('heroicon-o-check')
                    ->color('success')
                    ->requiresConfirmation()
                    ->action(function (Propina $record) {
                        $record->update([
                            'pago' => true,
                            'data_pagamento' => now(),
                        ]);
                    })
                    ->visible(fn (Propina $record) => !$record->pago),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
                Tables\Actions\BulkAction::make('marcarComoPago')
                    ->label('Marcar como Pagas')
                    ->icon('heroicon-o-check')
                    ->requiresConfirmation()
                    ->action(function ($records) {
                        $records->each->update([
                            'pago' => true,
                            'data_pagamento' => now(),
                        ]);
                    })
                    ->deselectRecordsAfterCompletion(),
            ])
            ->defaultSort('vencimento', 'asc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPropinas::route('/'),
            'create' => Pages\CreatePropina::route('/create'),
            'edit' => Pages\EditPropina::route('/{record}/edit'),
        ];
    }
}
