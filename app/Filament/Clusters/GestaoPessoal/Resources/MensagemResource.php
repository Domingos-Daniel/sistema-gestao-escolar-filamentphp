<?php

namespace App\Filament\Clusters\GestaoPessoal\Resources;

use App\Filament\Clusters\GestaoPessoal;
use App\Filament\Clusters\GestaoPessoal\Resources\MensagemResource\Pages;
use App\Filament\Clusters\GestaoPessoal\Resources\MensagemResource\RelationManagers;
use App\Models\Mensagem;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MensagemResource extends Resource
{
    protected static ?string $model = Mensagem::class;
    protected static ?string $cluster = GestaoPessoal::class;

    protected static ?string $navigationIcon = 'heroicon-o-envelope';
    protected static ?string $label = 'Mensagem';
    protected static ?string $pluralLabel = 'Mensagens';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('remetente_id')
                    ->relationship('remetente', 'name', fn ($query) => $query->whereIn('role', ['admin', 'funcionario']))
                    ->default(auth()->id())
                    ->label('Remetente'),
                Forms\Components\Select::make('destinatario_id')
                    ->relationship('destinatario', 'name', fn ($query) => $query->where('role', 'professor'))
                    ->required()
                    ->label('Destinatário'),
                Forms\Components\Textarea::make('conteudo')
                    ->required()
                    ->label('Mensagem'),
                Forms\Components\Toggle::make('lida')
                    ->label('Lida'),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('remetente.name')->label('Remetente'),
                Tables\Columns\TextColumn::make('destinatario.name')->label('Destinatário'),
                Tables\Columns\TextColumn::make('conteudo')->label('Mensagem')->limit(50),
                Tables\Columns\IconColumn::make('lida')->label('Lida')->getStateUsing(function ($record) {
                    return $record->lida ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle';
                })->boolean(),
                Tables\Columns\TextColumn::make('created_at')->label('Enviada em')->dateTime(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('lida')
                    ->options(['1' => 'Lidas', '0' => 'Não Lidas']),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ])
            ->defaultSort('created_at', 'desc');
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
            'index' => Pages\ListMensagems::route('/'),
            'create' => Pages\CreateMensagem::route('/create'),
            'edit' => Pages\EditMensagem::route('/{record}/edit'),
        ];
    }
}
