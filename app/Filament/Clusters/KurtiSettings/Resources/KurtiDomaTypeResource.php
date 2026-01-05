<?php

namespace App\Filament\Clusters\KurtiSettings\Resources;

use App\Filament\Clusters\KurtiSettings;
use App\Filament\Clusters\KurtiSettings\Resources\KurtiDomaTypeResource\Pages;
use App\Filament\Clusters\KurtiSettings\Resources\KurtiDomaTypeResource\RelationManagers;
use App\Models\KurtiDomaType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KurtiDomaTypeResource extends Resource
{
    protected static ?string $model = KurtiDomaType::class;

    protected static ?string $navigationIcon = 'heroicon-o-scissors';

    protected static ?string $navigationLabel = 'Kurti Daman Types';

    protected static ?string $cluster = KurtiSettings::class;

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
            'index' => Pages\ListKurtiDomaTypes::route('/'),
            'create' => Pages\CreateKurtiDomaType::route('/create'),
            'edit' => Pages\EditKurtiDomaType::route('/{record}/edit'),
        ];
    }
}
