<?php

namespace App\Filament\Clusters\GestaoPessoal\Resources;

use App\Filament\Clusters\GestaoPessoal;
use App\Filament\Clusters\GestaoPessoal\Resources\HorarioResource\Pages;
use App\Filament\Clusters\GestaoPessoal\Resources\HorarioResource\RelationManagers;
use App\Models\Horario;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HorarioResource extends Resource
{
    protected static ?string $model = Horario::class;
    protected static ?string $cluster = GestaoPessoal::class;

    protected static ?string $navigationIcon = 'heroicon-o-clock';
    protected static ?string $label = 'Horário';
    protected static ?string $pluralLabel = 'Horários';


    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'name', fn ($query) => $query->whereIn('role', ['professor', 'funcionario']))
                    ->required()
                    ->label('Professor/Funcionário'),
                Forms\Components\Select::make('turma_id')
                    ->relationship('turma', 'nome')
                    ->nullable()
                    ->label('Turma (opcional)'),
                Forms\Components\TimePicker::make('hora_inicio')
                    ->required()
                    ->label('Hora de Início'),
                Forms\Components\TimePicker::make('hora_fim')
                    ->required()
                    ->label('Hora de Fim'),
                Forms\Components\Select::make('dia_semana')
                    ->options([
                        'Segunda' => 'Segunda',
                        'Terça' => 'Terça',
                        'Quarta' => 'Quarta',
                        'Quinta' => 'Quinta',
                        'Sexta' => 'Sexta',
                        'Sábado' => 'Sábado',
                    ])
                    ->required()
                    ->label('Dia da Semana'),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.name')->label('Nome'),
                Tables\Columns\TextColumn::make('turma.nome')->label('Turma')
                ->getStateUsing(fn ($record) => $record->turma ? $record->turma->nome : 'N/A'),
                Tables\Columns\TextColumn::make('hora_inicio')->label('Início'),
                Tables\Columns\TextColumn::make('hora_fim')->label('Fim'),
                Tables\Columns\TextColumn::make('dia_semana')->label('Dia'),
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
            'index' => Pages\ListHorarios::route('/'),
            'create' => Pages\CreateHorario::route('/create'),
            'edit' => Pages\EditHorario::route('/{record}/edit'),
        ];
    }
}
