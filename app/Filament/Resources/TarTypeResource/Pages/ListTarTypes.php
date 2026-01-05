<?php

namespace App\Filament\Resources\TarTypeResource\Pages;

use App\Filament\Resources\TarTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTarTypes extends ListRecords
{
    protected static string $resource = TarTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
