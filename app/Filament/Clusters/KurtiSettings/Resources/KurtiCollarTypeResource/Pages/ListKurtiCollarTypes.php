<?php

namespace App\Filament\Clusters\KurtiSettings\Resources\KurtiCollarTypeResource\Pages;

use App\Filament\Clusters\KurtiSettings\Resources\KurtiCollarTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKurtiCollarTypes extends ListRecords
{
    protected static string $resource = KurtiCollarTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
