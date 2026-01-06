<?php

namespace App\Filament\Resources\CustomerOrderResource\Pages;

use App\Filament\Resources\CustomerOrderResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomerOrder extends CreateRecord
{
    protected static string $resource = CustomerOrderResource::class;
}
