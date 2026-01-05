<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AsitinTypeResource\Pages;
use App\Filament\Resources\AsitinTypeResource\RelationManagers;
use App\Models\AsitinType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Clusters\JamiSettings;

class AsitinTypeResource extends Resource
{
    protected static ?string $model = AsitinType::class;

    protected static ?string $navigationIcon = 'heroicon-o-squares-plus';

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
            'index' => Pages\ListAsitinTypes::route('/'),
            'create' => Pages\CreateAsitinType::route('/create'),
            'edit' => Pages\EditAsitinType::route('/{record}/edit'),
        ];
    }
}
