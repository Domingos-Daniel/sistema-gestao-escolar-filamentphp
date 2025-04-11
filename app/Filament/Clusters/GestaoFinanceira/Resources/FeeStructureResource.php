<?php

namespace App\Filament\Clusters\GestaoFinanceira\Resources;

use App\Filament\Clusters\GestaoFinanceira;
use App\Filament\Clusters\GestaoFinanceira\Resources\FeeStructureResource\Pages;
use App\Filament\Clusters\GestaoFinanceira\Resources\FeeStructureResource\RelationManagers;
use App\Models\Classe;
use App\Models\FeeStructure;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class FeeStructureResource extends Resource
{
    protected static ?string $model = FeeStructure::class;
    protected static ?string $cluster = GestaoFinanceira::class;

    protected static ?string $navigationIcon = 'heroicon-o-calculator';
    protected static ?string $label = 'Taxa';
    protected static ?string $pluralLabel = 'Taxas';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('ano_letivo_id')
                    ->relationship('anoLetivo', 'ano')
                    ->required()
                    ->label('Ano Letivo'),
                Forms\Components\Select::make('classe_id')
                    ->relationship('classe', 'nome')
                    ->required()
                    ->label('Classe')
                    ->reactive(),
                Forms\Components\Select::make('curso_id')
                    ->relationship('curso', 'nome')
                    ->nullable()
                    ->visible(fn (Forms\Get $get) => optional(Classe::find($get('classe_id')))->nivel >= 10)
                    ->label('Curso'),
                Forms\Components\TextInput::make('enrollment_fee')
                    ->numeric()
                    ->required()
                    ->label('Valor da Matrícula'),
                Forms\Components\TextInput::make('monthly_fee')
                    ->numeric()
                    ->required()
                    ->label('Propina Mensal'),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('anoLetivo.ano')->label('Ano Letivo'),
                Tables\Columns\TextColumn::make('classe.nome')->label('Classe'),
                Tables\Columns\TextColumn::make('curso.nome')->label('Curso')->default('N/A'),
                Tables\Columns\TextColumn::make('enrollment_fee')->label('Matrícula'),
                Tables\Columns\TextColumn::make('monthly_fee')->label('Propina Mensal'),
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
            'index' => Pages\ListFeeStructures::route('/'),
            'create' => Pages\CreateFeeStructure::route('/create'),
            'edit' => Pages\EditFeeStructure::route('/{record}/edit'),
        ];
    }
}
