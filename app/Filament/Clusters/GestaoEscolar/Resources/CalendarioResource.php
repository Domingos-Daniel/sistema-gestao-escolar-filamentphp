<?php

namespace App\Filament\Clusters\GestaoEscolar\Resources;

use App\Filament\Clusters\GestaoEscolar;
use App\Filament\Clusters\GestaoEscolar\Resources\CalendarioResource\Pages;
use App\Filament\Clusters\GestaoEscolar\Resources\CalendarioResource\RelationManagers;
use App\Models\Calendario;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CalendarioResource extends Resource
{
    protected static ?string $model = Calendario::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = GestaoEscolar::class;

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('ano_letivo_id')
                    ->relationship('anoLetivo', 'ano')
                    ->required()
                    ->label('Ano Letivo'),
                Forms\Components\DatePicker::make('data')
                    ->required()
                    ->label('Data'),
                Forms\Components\TextInput::make('evento')
                    ->required()
                    ->label('Evento'),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('anoLetivo.ano')->label('Ano Letivo'),
                Tables\Columns\TextColumn::make('data')->label('Data'),
                Tables\Columns\TextColumn::make('evento')->label('Evento'),
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
            'index' => Pages\ListCalendarios::route('/'),
            'create' => Pages\CreateCalendario::route('/create'),
            'edit' => Pages\EditCalendario::route('/{record}/edit'),
        ];
    }
}
