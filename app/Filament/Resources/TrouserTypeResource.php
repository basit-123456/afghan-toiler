<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrouserTypeResource\Pages;
use App\Filament\Resources\TrouserTypeResource\RelationManagers;
use App\Models\TrouserType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Clusters\JamiSettings;

class TrouserTypeResource extends Resource
{
    protected static ?string $model = TrouserType::class;

    protected static ?string $navigationIcon = 'heroicon-o-bars-3';

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
            'index' => Pages\ListTrouserTypes::route('/'),
            'create' => Pages\CreateTrouserType::route('/create'),
            'edit' => Pages\EditTrouserType::route('/{record}/edit'),
        ];
    }
}
