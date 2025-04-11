<?php

namespace App\Filament\Clusters\Relatorios\Resources;

use App\Filament\Clusters\Relatorios;
use App\Filament\Clusters\Relatorios\Resources\RelatorioResource\Pages;
use App\Filament\Clusters\Relatorios\Resources\RelatorioResource\RelationManagers;
use App\Models\Matricula;
use App\Models\Relatorio;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RelatorioResource extends Resource
{

    protected static ?string $cluster =Relatorios::class;

    protected static ?string $navigationIcon = 'heroicon-o-table-cells';
    protected static ?string $model = Matricula::class; // Usaremos Matricula como base

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('estudante.name')->label('Estudante'),
                Tables\Columns\TextColumn::make('turma.nome')->label('Turma'),
                Tables\Columns\TextColumn::make('data_matricula')->label('Data da Matrícula')->date(),
                Tables\Columns\TextColumn::make('propinas_sum_valor')
                    ->label('Total Propinas')
                    ->money('AOA'),
                Tables\Columns\TextColumn::make('propinas_count')
                    ->label('Nº de Propinas'),
            ])
            ->filters([
                Tables\Filters\Filter::make('propinas_pagas')
                    ->query(fn ($query) => $query->whereHas('propinas', fn ($q) => $q->where('pago', true))),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ]);
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
            'index' => Pages\ListRelatorios::route('/'),
            'create' => Pages\CreateRelatorio::route('/create'),
            'edit' => Pages\EditRelatorio::route('/{record}/edit'),
        ];
    }
}
