<?php

namespace App\Filament\Clusters\GestaoEscolar\Resources;

use App\Filament\Clusters\GestaoEscolar;
use App\Filament\Clusters\GestaoEscolar\Resources\TurnoResource\Pages;
use App\Filament\Clusters\GestaoEscolar\Resources\TurnoResource\RelationManagers;
use App\Models\Turno;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TurnoResource extends Resource
{
    protected static ?string $model = Turno::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = GestaoEscolar::class;

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nome')->required()->label('Nome'),
                Forms\Components\TimePicker::make('hora_inicio')
                    ->required()
                    ->label('Hora de Início'),
                Forms\Components\TimePicker::make('hora_fim')
                    ->required()
                    ->label('Hora de Fim'),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome')->label('Nome'),
                Tables\Columns\TextColumn::make('hora_inicio')->label('Início'),
                Tables\Columns\TextColumn::make('hora_fim')->label('Fim'),
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
            'index' => Pages\ListTurnos::route('/'),
            'create' => Pages\CreateTurno::route('/create'),
            'edit' => Pages\EditTurno::route('/{record}/edit'),
        ];
    }
}
