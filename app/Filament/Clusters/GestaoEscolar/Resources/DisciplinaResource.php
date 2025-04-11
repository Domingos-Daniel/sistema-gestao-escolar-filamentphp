<?php

namespace App\Filament\Clusters\GestaoEscolar\Resources;

use App\Filament\Clusters\GestaoEscolar;
use App\Filament\Clusters\GestaoEscolar\Resources\DisciplinaResource\Pages;
use App\Filament\Clusters\GestaoEscolar\Resources\DisciplinaResource\RelationManagers;
use App\Models\Classe;
use App\Models\Disciplina;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DisciplinaResource extends Resource
{
    protected static ?string $model = Disciplina::class;
    protected static ?string $cluster = GestaoEscolar::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nome')
                    ->required()
                    ->label('Nome da Disciplina'),
                Forms\Components\Select::make('classe_id')
                    ->relationship('classe', 'nome')
                    ->required()
                    ->label('Classe')
                    ->reactive(), // Para atualizar o campo curso dinamicamente
                Forms\Components\Select::make('curso_id')
                    ->relationship('curso', 'nome')
                    ->label('Curso')
                    ->nullable()
                    ->visible(fn (Forms\Get $get) => optional(Classe::find($get('classe_id')))->nivel >= 10)
                    ->required(fn (Forms\Get $get) => optional(Classe::find($get('classe_id')))->nivel >= 10)
                    ->helperText('Obrigatório apenas para classes da 10ª em diante.'),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome')->label('Disciplina'),
                Tables\Columns\TextColumn::make('classe.nome')->label('Classe'),
                Tables\Columns\TextColumn::make('curso.nome')->label('Curso')->default('N/A'),
            ])
            ->filters([
                //
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
            'index' => Pages\ListDisciplinas::route('/'),
            'create' => Pages\CreateDisciplina::route('/create'),
            'edit' => Pages\EditDisciplina::route('/{record}/edit'),
        ];
    }
}
