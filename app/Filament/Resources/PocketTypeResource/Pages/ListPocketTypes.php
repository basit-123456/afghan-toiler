<?php

namespace App\Filament\Resources\PocketTypeResource\Pages;

use App\Filament\Resources\PocketTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPocketTypes extends ListRecords
{
    protected static string $resource = PocketTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
