<?php

namespace App\Filament\Clusters\GestaoEscolar\Resources\CursoResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DisciplinasRelationManager extends RelationManager
{
    protected static string $relationship = 'disciplinas';

    public function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('nome')
                    ->required()
                    ->label('Nome da Disciplina'),
                Forms\Components\Select::make('classe_id')
                    ->relationship('classe', 'nome', fn ($query) => $query->where('curso_id', $this->ownerRecord->id))
                    ->required()
                    ->label('Classe')
                    ->helperText('Selecione a classe associada a este curso.'),
            ]);
    }

    public function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->recordTitleAttribute('nome')
            ->columns([
                Tables\Columns\TextColumn::make('nome')->label('Disciplina'),
                Tables\Columns\TextColumn::make('classe.nome')->label('Classe'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
}
