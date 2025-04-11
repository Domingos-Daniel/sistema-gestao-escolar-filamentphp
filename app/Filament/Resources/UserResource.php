<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Section;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    public static function canAccess(): bool
    {
        // Check if the user has appropriate permissions
        return auth()->user()->hasRole(['super_admin', 'admin']) || 
               auth()->user()->can('view_resource', User::class);
    }
    protected static ?string $navigationIcon = 'heroicon-o-users';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Wizard::make([
                    // Etapa 1: Informações Básicas
                    Wizard\Step::make('Informações Básicas')
                        ->schema([
                            TextInput::make('name')
                                ->required()
                                ->label('Nome'),
                            TextInput::make('email')
                                ->email()
                                ->required()
                                ->label('E-mail'),
                            TextInput::make('password')
                                ->password()
                                ->required()
                                ->label('Senha')
                                ->visibleOn('create')
                                ->hiddenOn('edit'),
                            Select::make('role')
                                ->options([
                                    'estudante' => 'Estudante',
                                    'professor' => 'Professor',
                                    'coordenador' => 'Coordenador',
                                    'funcionario' => 'Funcionário',
                                    'responsavel' => 'Responsável',
                                ])
                                ->required()
                                ->label('Tipo de Usuário')
                                ->reactive(),
                            Select::make('roles')
                                ->relationship('roles', 'name')
                                ->multiple()
                                ->preload()
                                ->searchable()
                                ->label('Papéis')
                                ->visible(fn () => auth()->user()->hasRole('super_admin')),
                        ]),
                    // Etapa 2: Detalhes do Usuário
                    Wizard\Step::make('Detalhes do Usuário')
                        ->schema([
                            // Seção para Estudante
                            Section::make('Informações do Estudante')
                                ->schema([
                                    DatePicker::make('data_nascimento')
                                        ->label('Data de Nascimento'),
                                    TextInput::make('numero_estudante')
                                        ->label('Número do Estudante'),
                                    Select::make('turma_id')
                                        ->relationship('turma', 'nome')
                                        ->label('Turma')
                                        ->helperText('Selecione a turma do estudante, se aplicável.'),
                                ])
                                ->visible(fn ($get) => $get('role') === 'estudante'),
                            // Outras seções permanecem como estão
                            Section::make('Informações do Professor')
                                ->schema([
                                    TextInput::make('especializacao')
                                        ->label('Especialização'),
                                    TextInput::make('numero_funcionario')
                                        ->label('Número do Funcionário'),
                                ])
                                ->visible(fn ($get) => $get('role') === 'professor'),
                            Section::make('Informações do Coordenador')
                                ->schema([
                                    TextInput::make('departamento')
                                        ->label('Departamento'),
                                ])
                                ->visible(fn ($get) => $get('role') === 'coordenador'),
                            Section::make('Informações do Funcionário')
                                ->schema([
                                    TextInput::make('cargo')
                                        ->label('Cargo'),
                                ])
                                ->visible(fn ($get) => $get('role') === 'funcionario'),
                            Section::make('Informações do Responsável')
                                ->schema([
                                    TextInput::make('relacao')
                                        ->label('Relação com o Estudante'),
                                ])
                                ->visible(fn ($get) => $get('role') === 'responsavel'),
                        ]),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_verified_at')
                    ->dateTime()
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
            RelationManagers\NotasRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
