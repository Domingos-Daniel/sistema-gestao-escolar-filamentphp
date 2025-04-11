<?php

namespace App\Filament\Resources;

use App\Filament\Clusters\GestaoEscolar;
use App\Filament\Resources\AnoLetivoResource\Pages;
use App\Filament\Resources\AnoLetivoResource\RelationManagers;
use App\Models\AnoLetivo;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AnoLetivoResource extends Resource
{
    protected static ?string $model = AnoLetivo::class;
    protected static ?string $cluster = GestaoEscolar::class;
    protected static ?string $label = 'Ano Letivo';
    protected static ?string $pluralLabel = 'Anos Letivos';
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('ano')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('data_inicio')
                    ->required(),
                Forms\Components\DatePicker::make('data_fim')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('ano')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('data_inicio')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('data_fim')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListAnoLetivos::route('/'),
            'create' => Pages\CreateAnoLetivo::route('/create'),
            'edit' => Pages\EditAnoLetivo::route('/{record}/edit'),
        ];
    }
}
