<?php

namespace App\Filament\Clusters\KurtiSettings\Resources;

use App\Filament\Clusters\KurtiSettings;
use App\Filament\Clusters\KurtiSettings\Resources\KurtiButtonTypeResource\Pages;
use App\Filament\Clusters\KurtiSettings\Resources\KurtiButtonTypeResource\RelationManagers;
use App\Models\KurtiButtonType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KurtiButtonTypeResource extends Resource
{
    protected static ?string $model = KurtiButtonType::class;

    protected static ?string $navigationIcon = 'heroicon-o-stop';

    protected static ?string $navigationLabel = 'Kurti Button Types';

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
            'index' => Pages\ListKurtiButtonTypes::route('/'),
            'create' => Pages\CreateKurtiButtonType::route('/create'),
            'edit' => Pages\EditKurtiButtonType::route('/{record}/edit'),
        ];
    }
}
