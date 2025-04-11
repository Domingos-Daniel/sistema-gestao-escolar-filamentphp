<?php

namespace App\Filament\Clusters\GestaoPessoal\Resources;

use App\Filament\Clusters\GestaoPessoal;
use App\Filament\Clusters\GestaoPessoal\Resources\PontoResource\Pages;
use App\Filament\Clusters\GestaoPessoal\Resources\PontoResource\RelationManagers;
use App\Models\Ponto;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PontoResource extends Resource
{
    protected static ?string $model = Ponto::class;
    protected static ?string $cluster = GestaoPessoal::class;
    protected static ?string $navigationIcon = 'heroicon-o-check-circle';
    protected static ?string $label = 'Livro de Ponto';
    protected static ?string $pluralLabel = 'Livros de Ponto';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name', fn ($query) => $query->whereIn('role', ['professor', 'funcionario']))
                    ->required()
                    ->label('Professor/Funcionário'),
                Forms\Components\DateTimePicker::make('entrada')
                    ->required()
                    ->label('Entrada'),
                Forms\Components\DateTimePicker::make('saida')
                    ->nullable()
                    ->label('Saída'),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('Nome'),
                Tables\Columns\TextColumn::make('entrada')->label('Entrada')->dateTime(),
                Tables\Columns\TextColumn::make('saida')->label('Saída')->dateTime()->default('N/A'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('entrada', 'desc');
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
            'index' => Pages\ListPontos::route('/'),
            'create' => Pages\CreatePonto::route('/create'),
            'edit' => Pages\EditPonto::route('/{record}/edit'),
        ];
    }
}
