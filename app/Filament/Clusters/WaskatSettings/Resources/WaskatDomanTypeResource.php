<?php

namespace App\Filament\Clusters\WaskatSettings\Resources;

use App\Filament\Clusters\WaskatSettings;
use App\Filament\Clusters\WaskatSettings\Resources\WaskatDomanTypeResource\Pages;
use App\Filament\Clusters\WaskatSettings\Resources\WaskatDomanTypeResource\RelationManagers;
use App\Models\WaskatDomanType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WaskatDomanTypeResource extends Resource
{
    protected static ?string $model = WaskatDomanType::class;

    protected static ?string $navigationIcon = 'heroicon-o-scissors';

    protected static ?string $navigationLabel = 'Waskat Doman Types';

    protected static ?string $cluster = WaskatSettings::class;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
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
            'index' => Pages\ListWaskatDomanTypes::route('/'),
            'create' => Pages\CreateWaskatDomanType::route('/create'),
            'edit' => Pages\EditWaskatDomanType::route('/{record}/edit'),
        ];
    }
}
