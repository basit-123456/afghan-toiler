<?php

namespace App\Filament\Resources\ShoulderTypeResource\Pages;

use App\Filament\Resources\ShoulderTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListShoulderTypes extends ListRecords
{
    protected static string $resource = ShoulderTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
