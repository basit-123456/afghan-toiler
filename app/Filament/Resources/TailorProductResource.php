<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TailorProductResource\Pages;
use App\Filament\Resources\TailorProductResource\RelationManagers;
use App\Models\TailorProduct;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TailorProductResource extends Resource
{
    protected static ?string $model = TailorProduct::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationGroup = 'Product Management';

    protected static ?int $navigationSort = 2;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('product_category_id')
                    ->relationship('category', 'name')
                    ->required()
                    ->createOptionForm([
                        Forms\Components\TextInput::make('name')
                            ->required(),
                        Forms\Components\FileUpload::make('image')
                            ->image()
                            ->directory('product-categories'),
                    ])
                    ->label('Product Category'),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255)
                    ->label('Product Name'),
                Forms\Components\TextInput::make('price')
                    ->required()
                    ->numeric()
                    ->prefix('؋')
                    ->step(0.01),
                Forms\Components\Textarea::make('description')
                    ->rows(3)
                    ->label('Product Description'),
                Forms\Components\FileUpload::make('main_image')
                    ->required()
                    ->image()
                    ->directory('tailor-products')
                    ->label('Main Image'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('main_image')
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->sortable()
                    ->label('Category'),
                Tables\Columns\TextColumn::make('price')
                    ->money('AFN')
                    ->sortable(),
                Tables\Columns\TextColumn::make('description')
                    ->limit(30)
                    ->toggleable(),
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
            'index' => Pages\ListTailorProducts::route('/'),
            'create' => Pages\CreateTailorProduct::route('/create'),
            'edit' => Pages\EditTailorProduct::route('/{record}/edit'),
        ];
    }
}
