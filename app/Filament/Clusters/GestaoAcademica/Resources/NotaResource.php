<?php

namespace App\Filament\Clusters\GestaoAcademica\Resources;

use App\Filament\Clusters\GestaoAcademica;
use App\Filament\Clusters\GestaoAcademica\Resources\NotaResource\Pages;
use App\Filament\Clusters\GestaoAcademica\Resources\NotaResource\RelationManagers;
use App\Models\Nota;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NotaResource extends Resource
{
    protected static ?string $model = Nota::class;
    protected static ?string $cluster = GestaoAcademica::class;

    protected static ?string $navigationIcon = 'heroicon-o-chart-bar';
    protected static ?string $label = 'Notas';
    protected static ?string $pluralLabel = 'Notas';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('estudante_id')
                    ->relationship('estudante', 'name', fn ($query) => $query->where('role', 'estudante'))
                    ->required()
                    ->label('Estudante')
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $set('disciplina_id', null);
                    }),
                Forms\Components\Select::make('disciplina_id')
                    ->relationship('disciplina', 'nome', function ($query, Forms\Get $get) {
                        $estudante = User::find($get('estudante_id'));
                        if ($estudante && $estudante->turma) {
                            return $query->where('classe_id', $estudante->turma->classe_id);
                        }
                        return $query;
                    })
                    ->required()
                    ->label('Disciplina'),
                Forms\Components\Select::make('avaliacao_id')
                    ->relationship('avaliacao', 'nome', fn ($query, Forms\Get $get) => $query->where('turma_id', optional(User::find($get('estudante_id')))->turma_id))
                    ->nullable()
                    ->label('Avaliação'),
                Forms\Components\TextInput::make('nota')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(20)
                    ->required()
                    ->label('Nota'),
                Forms\Components\Select::make('ano_letivo_id')
                    ->relationship('anoLetivo', 'ano')
                    ->required()
                    ->label('Ano Letivo'),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('estudante.name')->label('Estudante'),
                Tables\Columns\TextColumn::make('disciplina.nome')->label('Disciplina'),
                Tables\Columns\TextColumn::make('avaliacao.nome')->label('Avaliação')->default('N/A'),
                Tables\Columns\TextColumn::make('nota')->label('Nota'),
                Tables\Columns\TextColumn::make('anoLetivo.ano')->label('Ano Letivo'),
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
            'index' => Pages\ListNotas::route('/'),
            'create' => Pages\CreateNota::route('/create'),
            'edit' => Pages\EditNota::route('/{record}/edit'),
        ];
    }
}
