<?php

namespace App\Filament\Resources\CustomerOrderResource\Pages;

use App\Filament\Resources\CustomerOrderResource;
use Filament\Actions;
use Filament\Forms;
use Filament\Resources\Pages\EditRecord;

class EditCustomerOrder extends EditRecord
{
    protected static string $resource = CustomerOrderResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('add_payment')
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
                ->action(function (array $data) {
                    $this->record->payments()->create($data);
                    
                    // Update paid_amount in customer_order
                    $this->record->update([
                        'paid_amount' => $this->record->payments()->sum('amount')
                    ]);
                })
                ->color('success'),
            Actions\Action::make('print')
                ->label('Print Order')
                ->icon('heroicon-o-printer')
                ->url(fn (): string => route('orders.print', $this->record))
                ->openUrlInNewTab(),
            Actions\DeleteAction::make(),
        ];
    }
}
