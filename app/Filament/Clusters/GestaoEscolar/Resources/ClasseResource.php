<?php

namespace App\Filament\Clusters\GestaoEscolar\Resources;

use App\Filament\Clusters\GestaoEscolar;
use App\Filament\Clusters\GestaoEscolar\Resources\ClasseResource\Pages;
use App\Filament\Clusters\GestaoEscolar\Resources\ClasseResource\RelationManagers;
use App\Models\Classe;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ClasseResource extends Resource
{
    protected static ?string $model = Classe::class;
    protected static ?string $cluster = GestaoEscolar::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nome')
                    ->required()
                    ->label('Nome da Classe')
                    ->placeholder('Ex.: 1ª Classe, 12ª Classe'),
                Forms\Components\TextInput::make('nivel')
                    ->numeric()
                    ->required()
                    ->label('Nível')
                    ->helperText('0 para Iniciação, 1 para 1ª Classe, etc.'),
                Forms\Components\Select::make('curso_id')
                    ->relationship('curso', 'nome')
                    ->label('Curso')
                    ->nullable()
                    ->visible(fn (Forms\Get $get) => (int) $get('nivel') >= 10) // Aparece apenas para 10ª ou superior
                    ->helperText('Obrigatório apenas para classes da 10ª em diante.'),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome')->label('Classe'),
                Tables\Columns\TextColumn::make('nivel')->label('Nível'),
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
            'index' => Pages\ListClasses::route('/'),
            'create' => Pages\CreateClasse::route('/create'),
            'edit' => Pages\EditClasse::route('/{record}/edit'),
        ];
    }
}
