<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CustomerOrderResource\Pages;
use App\Filament\Resources\CustomerOrderResource\RelationManagers;
use App\Models\CustomerOrder;
use App\Models\Customer;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CustomerOrderResource extends Resource
{
    protected static ?string $model = CustomerOrder::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-cart';

    protected static ?string $navigationGroup = 'Customer Management';

    protected static ?int $navigationSort = 2;

    protected static ?string $navigationLabel = 'Customer Orders';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Order Details')
                    ->schema([
                        Forms\Components\TextInput::make('unique_id')
                            ->label('Unique ID')
                            ->disabled()
                            ->dehydrated(false)
                            ->placeholder('Automatically Generated'),
                        
                        Forms\Components\Select::make('customer_id')
                            ->relationship('customer', 'name')
                            ->required()
                            ->searchable()
                            ->preload()
                            ->createOptionForm([
                                Forms\Components\TextInput::make('name')
                                    ->required(),
                                Forms\Components\TextInput::make('phone_number')
                                    ->required()
                                    ->unique(),
                            ])
                            ->label('Customer'),
                    ]),

                Forms\Components\Section::make('Order Item')
                    ->schema([
                        Forms\Components\Select::make('order_item')
                            ->options([
                                'Jami' => 'Jami',
                                'Kurti' => 'Kurti',
                                'Waskat' => 'Waskat',
                            ])
                            ->required(),
                        
                        Forms\Components\TextInput::make('quantity')
                            ->required()
                            ->numeric()
                            ->default(1)
                            ->minValue(1)
                            ->live()
                            ->afterStateUpdated(fn ($state, Forms\Set $set, Forms\Get $get) => 
                                self::updateTotalSpent($set, $get)),
                        
                        Forms\Components\TextInput::make('price')
                            ->required()
                            ->numeric()
                            ->prefix('؋')
                            ->step(0.01)
                            ->live()
                            ->afterStateUpdated(fn ($state, Forms\Set $set, Forms\Get $get) => 
                                self::updateTotalSpent($set, $get)),
                        
                        Forms\Components\TextInput::make('clothes_price')
                            ->required()
                            ->numeric()
                            ->prefix('؋')
                            ->step(0.01)
                            ->default(0)
                            ->live()
                            ->afterStateUpdated(fn ($state, Forms\Set $set, Forms\Get $get) => 
                                self::updateTotalSpent($set, $get)),
                        
                        Forms\Components\TextInput::make('total_spent')
                            ->disabled()
                            ->prefix('؋')
                            ->dehydrated(false)
                            ->default(0),
                        
                        Forms\Components\TextInput::make('paid_amount')
                            ->required()
                            ->numeric()
                            ->prefix('؋')
                            ->step(0.01)
                            ->label('Total Paid'),
                    ]),

                Forms\Components\Section::make('Payment Information')
                    ->schema([
                        Forms\Components\TextInput::make('paid_amount')
                            ->required()
                            ->numeric()
                            ->prefix('؋')
                            ->step(0.01)
                            ->label('Initial Payment'),
                    ]),

                Forms\Components\Section::make('Additional Details')
                    ->schema([
                        Forms\Components\DatePicker::make('finish_date')
                            ->required()
                            ->default(now()),
                        
                        Forms\Components\Textarea::make('notes')
                            ->rows(3),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('unique_id')
                    ->label('Unique ID')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('customer.name')
                    ->label('Customer Name')
                    ->searchable()
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('order_item')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'Jami' => 'success',
                        'Kurti' => 'info',
                        'Waskat' => 'warning',
                        default => 'gray',
                    }),
                
                Tables\Columns\TextColumn::make('quantity')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('price')
                    ->money('AFN')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('clothes_price')
                    ->money('AFN')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('paid_amount')
                    ->money('AFN')
                    ->sortable(),
                
                Tables\Columns\TextColumn::make('delivery_status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'warning',
                        'delivered' => 'info',
                        'paid_complete' => 'success',
                        default => 'gray',
                    })
                    ->formatStateUsing(fn (string $state): string => match ($state) {
                        'pending' => 'Pending',
                        'delivered' => 'Delivered',
                        'paid_complete' => 'Paid & Complete',
                        default => $state,
                    }),
                
                Tables\Columns\TextColumn::make('finish_date')
                    ->date()
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('order_item')
                    ->options([
                        'Jami' => 'Jami',
                        'Kurti' => 'Kurti',
                        'Waskat' => 'Waskat',
                    ]),
                
                Tables\Filters\SelectFilter::make('delivery_status')
                    ->options([
                        'pending' => 'Pending',
                        'delivered' => 'Delivered',
                        'paid_complete' => 'Paid & Complete',
                    ]),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('add_payment')
                    ->label('Add Payment')
                    ->icon('heroicon-o-banknotes')
                    ->form([
                        Forms\Components\TextInput::make('amount')
                            ->required()
                            ->numeric()
                            ->prefix('؋')
                            ->step(0.01),
                        Forms\Components\Select::make('payment_method')
                            ->required()
                            ->options([
                                'cash' => 'Cash',
                                'card' => 'Card',
                                'bank_transfer' => 'Bank Transfer',
                                'mobile_money' => 'Mobile Money',
                            ]),
                        Forms\Components\Textarea::make('notes')
                            ->rows(2),
                    ])
                    ->action(function (CustomerOrder $record, array $data) {
                        $record->payments()->create($data);
                        
                        // Update paid_amount in customer_order
                        $record->update([
                            'paid_amount' => $record->payments()->sum('amount')
                        ]);
                    })
                    ->color('success'),
                Tables\Actions\Action::make('print')
                    ->icon('heroicon-o-printer')
                    ->url(fn (CustomerOrder $record): string => route('orders.print', $record))
                    ->openUrlInNewTab(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('print_selected')
                        ->label('Print Selected')
                        ->icon('heroicon-o-printer')
                        ->action(function (\Illuminate\Database\Eloquent\Collection $records) {
                            $urls = $records->map(fn ($record) => route('orders.print', $record))->toArray();
                            return redirect()->back()->with('print_urls', $urls);
                        }),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getWidgets(): array
    {
        return [
            CustomerOrderResource\Widgets\CustomerOrderStatsWidget::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomerOrders::route('/'),
            'create' => Pages\CreateCustomerOrder::route('/create'),
            'edit' => Pages\EditCustomerOrder::route('/{record}/edit'),
        ];
    }

    private static function updateTotalSpent(Forms\Set $set, Forms\Get $get): void
    {
        $price = (float) $get('price') ?: 0;
        $clothesPrice = (float) $get('clothes_price') ?: 0;
        $total = $price + $clothesPrice;
        
        $set('total_spent', number_format($total, 2));
    }
}