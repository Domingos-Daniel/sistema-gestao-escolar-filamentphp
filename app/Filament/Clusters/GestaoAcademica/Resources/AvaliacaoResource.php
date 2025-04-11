<?php

namespace App\Filament\Clusters\GestaoAcademica\Resources;

use App\Filament\Clusters\GestaoAcademica;
use App\Filament\Clusters\GestaoAcademica\Resources\AvaliacaoResource\Pages;
use App\Filament\Clusters\GestaoAcademica\Resources\AvaliacaoResource\RelationManagers;
use App\Models\Avaliacao;
use App\Models\Turma;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AvaliacaoResource extends Resource
{
    protected static ?string $model = Avaliacao::class;
    protected static ?string $cluster = GestaoAcademica::class;

    protected static ?string $navigationIcon = 'heroicon-o-clipboard';
    protected static ?string $label = 'Avaliações';
    protected static ?string $pluralLabel = 'Avaliações';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('turma_id')
                    ->relationship('turma', 'nome')
                    ->required()
                    ->label('Turma')
                    ->reactive(),
                Forms\Components\Select::make('disciplina_id')
                    ->relationship('disciplina', 'nome', fn ($query, Forms\Get $get) => $query->where('classe_id', optional(Turma::find($get('turma_id')))->classe_id))
                    ->required()
                    ->label('Disciplina'),
                Forms\Components\TextInput::make('nome')
                    ->required()
                    ->label('Nome da Avaliação'),
                Forms\Components\DatePicker::make('data')
                    ->required()
                    ->label('Data'),
                Forms\Components\TextInput::make('peso')
                    ->numeric()
                    ->default(1)
                    ->minValue(0)
                    ->label('Peso'),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('turma.nome')->label('Turma'),
                Tables\Columns\TextColumn::make('disciplina.nome')->label('Disciplina'),
                Tables\Columns\TextColumn::make('nome')->label('Avaliação'),
                Tables\Columns\TextColumn::make('data')->label('Data'),
                Tables\Columns\TextColumn::make('peso')->label('Peso'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListAvaliacaos::route('/'),
            'create' => Pages\CreateAvaliacao::route('/create'),
            'edit' => Pages\EditAvaliacao::route('/{record}/edit'),
        ];
    }
}
