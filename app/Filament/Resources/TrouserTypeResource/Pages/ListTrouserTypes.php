<?php

namespace App\Filament\Resources\TrouserTypeResource\Pages;

use App\Filament\Resources\TrouserTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTrouserTypes extends ListRecords
{
    protected static string $resource = TrouserTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
