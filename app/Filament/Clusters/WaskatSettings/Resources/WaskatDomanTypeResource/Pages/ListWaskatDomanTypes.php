<?php

namespace App\Filament\Clusters\WaskatSettings\Resources\WaskatDomanTypeResource\Pages;

use App\Filament\Clusters\WaskatSettings\Resources\WaskatDomanTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListWaskatDomanTypes extends ListRecords
{
    protected static string $resource = WaskatDomanTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
