<?php

namespace App\Filament\Clusters\GestaoPessoal\Resources;

use App\Filament\Clusters\GestaoPessoal;
use App\Filament\Clusters\GestaoPessoal\Resources\AtribuicaoDisciplinaResource\Pages;
use App\Filament\Clusters\GestaoPessoal\Resources\AtribuicaoDisciplinaResource\RelationManagers;
use App\Models\AtribuicaoDisciplina;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AtribuicaoDisciplinaResource extends Resource
{
    protected static ?string $model = AtribuicaoDisciplina::class;
    protected static ?string $cluster = GestaoPessoal::class;

    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $label = 'Atribuição de Disciplina';
    protected static ?string $pluralLabel = 'Atribuições de Disciplinas';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('professor_id')
                    ->relationship('professor', 'name', fn ($query) => $query->where('role', 'professor'))
                    ->required()
                    ->label('Professor'),
                Forms\Components\Select::make('disciplina_id')
                    ->relationship('disciplina', 'nome')
                    ->required()
                    ->label('Disciplina'),
                Forms\Components\Select::make('turma_id')
                    ->relationship('turma', 'nome')
                    ->required()
                    ->label('Turma'),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('professor.name')->label('Professor'),
                Tables\Columns\TextColumn::make('disciplina.nome')->label('Disciplina'),
                Tables\Columns\TextColumn::make('turma.nome')->label('Turma'),
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
            'index' => Pages\ListAtribuicaoDisciplinas::route('/'),
            'create' => Pages\CreateAtribuicaoDisciplina::route('/create'),
            'edit' => Pages\EditAtribuicaoDisciplina::route('/{record}/edit'),
        ];
    }
}
