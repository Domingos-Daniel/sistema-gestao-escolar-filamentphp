<?php

namespace App\Filament\Clusters\GestaoEscolar\Resources;

use App\Filament\Clusters\GestaoEscolar;
use App\Filament\Clusters\GestaoEscolar\Resources\SalaResource\Pages;
use App\Filament\Clusters\GestaoEscolar\Resources\SalaResource\RelationManagers;
use App\Models\Sala;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SalaResource extends Resource
{
    protected static ?string $model = Sala::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = GestaoEscolar::class;

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nome')->required()->label('Nome'),
                Forms\Components\TextInput::make('capacidade')
                    ->numeric()
                    ->required()
                    ->label('Capacidade'),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome')->label('Nome'),
                Tables\Columns\TextColumn::make('capacidade')->label('Capacidade'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            'index' => Pages\ListSalas::route('/'),
            'create' => Pages\CreateSala::route('/create'),
            'edit' => Pages\EditSala::route('/{record}/edit'),
        ];
    }
}
