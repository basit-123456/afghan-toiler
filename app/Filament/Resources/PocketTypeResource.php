<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PocketTypeResource\Pages;
use App\Filament\Resources\PocketTypeResource\RelationManagers;
use App\Models\PocketType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Clusters\JamiSettings;

class PocketTypeResource extends Resource
{
    protected static ?string $model = PocketType::class;

    protected static ?string $navigationIcon = 'heroicon-o-archive-box';

    protected static ?string $cluster = JamiSettings::class;

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
            'index' => Pages\ListPocketTypes::route('/'),
            'create' => Pages\CreatePocketType::route('/create'),
            'edit' => Pages\EditPocketType::route('/{record}/edit'),
        ];
    }
}
