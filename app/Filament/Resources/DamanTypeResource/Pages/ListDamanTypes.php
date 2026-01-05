<?php

namespace App\Filament\Resources\DamanTypeResource\Pages;

use App\Filament\Resources\DamanTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDamanTypes extends ListRecords
{
    protected static string $resource = DamanTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
