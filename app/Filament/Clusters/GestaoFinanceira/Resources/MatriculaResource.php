<?php

namespace App\Filament\Clusters\GestaoFinanceira\Resources;

use App\Filament\Clusters\GestaoFinanceira;
use App\Filament\Clusters\GestaoFinanceira\Resources\MatriculaResource\Pages;
use App\Filament\Clusters\GestaoFinanceira\Resources\MatriculaResource\RelationManagers;
use App\Models\FeeStructure;
use App\Models\Matricula;
use App\Models\Turma;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MatriculaResource extends Resource
{
    protected static ?string $model = Matricula::class;
    protected static ?string $cluster = GestaoFinanceira::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('estudante_id')
                    ->relationship('estudante', 'name', fn ($query) => $query->where('role', 'estudante'))
                    ->required()
                    ->label('Estudante'),
                Forms\Components\Select::make('turma_id')
                    ->relationship('turma', 'nome')
                    ->required()
                    ->label('Turma')
                    ->reactive()
                    ->afterStateUpdated(function ($state, callable $set) {
                        $turma = \App\Models\Turma::find($state);
                        if ($turma) {
                            $feeStructure = FeeStructure::where('ano_letivo_id', $turma->ano_letivo_id)
                                ->where('classe_id', $turma->classe_id)
                                ->where(function ($query) use ($turma) {
                                    $query->where('curso_id', $turma->curso_id)
                                          ->orWhereNull('curso_id');
                                })
                                ->first();
                            $set('fee_structure_id', $feeStructure?->id);
                            $set('valor_matricula', $feeStructure?->enrollment_fee);
                        }
                    }),
                Forms\Components\Hidden::make('fee_structure_id'),
                Forms\Components\DatePicker::make('data_matricula')
                    ->required()
                    ->label('Data da Matrícula'),
                Forms\Components\TextInput::make('valor_matricula')
                    ->numeric()
                    ->required()
                    ->label('Valor da Matrícula')
                    ->disabled(), // Valor vem de FeeStructure
                Forms\Components\Select::make('status')
                    ->options(['Pendente' => 'Pendente', 'Pago' => 'Pago'])
                    ->required()
                    ->label('Status'),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('estudante.name')->label('Estudante'),
                Tables\Columns\TextColumn::make('turma.nome')->label('Turma'),
                Tables\Columns\TextColumn::make('data_matricula')->label('Data'),
                Tables\Columns\TextColumn::make('valor_matricula')->label('Valor'),
                Tables\Columns\TextColumn::make('status')->label('Status'),
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
            RelationManagers\PropinasRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMatriculas::route('/'),
            'create' => Pages\CreateMatricula::route('/create'),
            'edit' => Pages\EditMatricula::route('/{record}/edit'),
        ];
    }
}
