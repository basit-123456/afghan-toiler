<?php

namespace App\Filament\Clusters\KurtiSettings\Resources\KurtiDomaTypeResource\Pages;

use App\Filament\Clusters\KurtiSettings\Resources\KurtiDomaTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKurtiDomaTypes extends ListRecords
{
    protected static string $resource = KurtiDomaTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
