<?php

namespace App\Filament\Clusters\GestaoEscolar\Resources;

use App\Filament\Clusters\GestaoEscolar;
use App\Filament\Clusters\GestaoEscolar\Resources\TurmaResource\Pages;
use App\Filament\Clusters\GestaoEscolar\Resources\TurmaResource\RelationManagers;
use App\Filament\Clusters\GestaoEscolar\Resources\TurmaResource\RelationManagers\DevedoresRelationManager;
use App\Filament\Clusters\GestaoEscolar\Resources\TurmaResource\RelationManagers\EstudantesRelationManager;
use App\Models\Classe;
use App\Models\Turma;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TurmaResource extends Resource
{
    protected static ?string $model = Turma::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $cluster = GestaoEscolar::class;

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nome')
                    ->required()
                    ->label('Nome'),
                Forms\Components\Select::make('ano_letivo_id')
                    ->relationship('anoLetivo', 'ano')
                    ->required()
                    ->label('Ano Letivo'),
                Forms\Components\Select::make('classe_id')
                    ->relationship('classe', 'nome')
                    ->required()
                    ->label('Classe')
                    ->reactive(), // Para atualizar o curso dinamicamente
                Forms\Components\Select::make('curso_id')
                    ->relationship('curso', 'nome')
                    ->label('Curso')
                    ->nullable() // Permite que seja opcional
                    ->required(fn (Forms\Get $get) => optional(Classe::find($get('classe_id')))->nivel >= 10)
                    ->disabled(fn (Forms\Get $get) => optional(Classe::find($get('classe_id')))->nivel < 10)
                    ->helperText('Obrigatório apenas para classes da 10ª em diante.'),
                Forms\Components\Select::make('turno_id')
                    ->relationship('turno', 'nome')
                    ->required()
                    ->label('Turno'),
                Forms\Components\Select::make('sala_id')
                    ->relationship('sala', 'nome')
                    ->label('Sala'),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('nome')->label('Nome'),
                Tables\Columns\TextColumn::make('anoLetivo.ano')->label('Ano Letivo'),
                Tables\Columns\TextColumn::make('classe.nome')->label('Classe'),
                Tables\Columns\TextColumn::make('curso.nome')->label('Curso')->default('N/A'),
                Tables\Columns\TextColumn::make('turno.nome')->label('Turno'),
                Tables\Columns\TextColumn::make('sala.nome')->label('Sala'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            EstudantesRelationManager::class,
            DevedoresRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTurmas::route('/'),
            'create' => Pages\CreateTurma::route('/create'),
            'edit' => Pages\EditTurma::route('/{record}/edit'),
        ];
    }
}
