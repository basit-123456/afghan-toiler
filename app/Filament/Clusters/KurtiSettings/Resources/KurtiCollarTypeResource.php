<?php

namespace App\Filament\Clusters\KurtiSettings\Resources;

use App\Filament\Clusters\KurtiSettings;
use App\Filament\Clusters\KurtiSettings\Resources\KurtiCollarTypeResource\Pages;
use App\Filament\Clusters\KurtiSettings\Resources\KurtiCollarTypeResource\RelationManagers;
use App\Models\KurtiCollarType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class KurtiCollarTypeResource extends Resource
{
    protected static ?string $model = KurtiCollarType::class;

    protected static ?string $navigationIcon = 'heroicon-o-ellipsis-horizontal';

    protected static ?string $navigationLabel = 'Kurti Collar Types';

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
            'index' => Pages\ListKurtiCollarTypes::route('/'),
            'create' => Pages\CreateKurtiCollarType::route('/create'),
            'edit' => Pages\EditKurtiCollarType::route('/{record}/edit'),
        ];
    }
}
