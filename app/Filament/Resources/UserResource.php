<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UserResource\Pages;
use App\Filament\Resources\UserResource\RelationManagers;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UserResource extends Resource
{
    protected static ?string $model = User::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Configuration';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->placeholder('Enter user name')
                    ->maxLength(255),

                Forms\Components\TextInput::make('email')
                    ->email()
                    ->required()
                    ->placeholder('Enter email address')
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                Forms\Components\TextInput::make('phone_number')
                    ->tel()
                    ->placeholder('Enter phone number')
                    ->maxLength(255),

                Forms\Components\TextInput::make('password')
                    ->password()
                    ->required()
                    ->placeholder('Enter a strong password')
                    ->dehydrateStateUsing(fn ($state) => bcrypt($state))
                    ->dehydrated(fn ($state) => filled($state))
                    ->required(fn (string $context): bool => $context === 'create')
                    ->maxLength(255),

                Forms\Components\TextInput::make('tailor_name')
                    ->required()
                    ->placeholder('Enter Tailor Name')
                    ->maxLength(255),

                Forms\Components\TextInput::make('tailor_pricing')
                    ->required()
                    ->numeric()
                    ->prefix('؋')
                    ->placeholder('Tailor Pricing')
                    ->step(0.01),

                Forms\Components\TextInput::make('waskat_tailor_pricing')
                    ->required()
                    ->numeric()
                    ->prefix('؋')
                    ->placeholder('Tailor Pricing')
                    ->step(0.01),

                Forms\Components\TextInput::make('kurit_tailor_pricing')
                    ->required()
                    ->numeric()
                    ->prefix('؋')
                    ->placeholder('Tailor Pricing')
                    ->step(0.01),

                Forms\Components\TextInput::make('patloon_tailor_pricing')
                    ->required()
                    ->numeric()
                    ->prefix('؋')
                    ->placeholder('Tailor Pricing')
                    ->step(0.01),

                Forms\Components\Textarea::make('full_address')
                    ->placeholder('Full Address')
                    ->rows(3),

                Forms\Components\FileUpload::make('logo')
                    ->image()
                    ->directory('logos')
                    ->placeholder('No file chosen'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('phone_number')
                    ->searchable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('tailor_name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('tailor_pricing')
                    ->money('AFN')
                    ->sortable()
                    ->toggleable(),

                Tables\Columns\TextColumn::make('waskat_tailor_pricing')
                    ->money('AFN')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('kurit_tailor_pricing')
                    ->money('AFN')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('patloon_tailor_pricing')
                    ->money('AFN')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                Tables\Columns\TextColumn::make('full_address')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->limit(30),

                Tables\Columns\ImageColumn::make('logo')
                    ->circular()
                    ->toggleable(),

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
                Tables\Filters\SelectFilter::make('tailor_name')
                    ->options(fn () => \App\Models\User::pluck('tailor_name', 'tailor_name')->unique()->toArray())
                    ->searchable(),

                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from'),
                        Forms\Components\DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
                            )
                            ->when(
                                $data['created_until'],
                                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
                            );
                    }),
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
            'index' => Pages\ListUsers::route('/'),
            'create' => Pages\CreateUser::route('/create'),
            'edit' => Pages\EditUser::route('/{record}/edit'),
        ];
    }
}
