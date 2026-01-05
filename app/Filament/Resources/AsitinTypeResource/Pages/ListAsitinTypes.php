<?php

namespace App\Filament\Resources\AsitinTypeResource\Pages;

use App\Filament\Resources\AsitinTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAsitinTypes extends ListRecords
{
    protected static string $resource = AsitinTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
