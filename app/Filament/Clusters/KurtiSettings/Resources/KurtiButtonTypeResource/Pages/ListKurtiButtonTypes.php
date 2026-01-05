<?php

namespace App\Filament\Clusters\KurtiSettings\Resources\KurtiButtonTypeResource\Pages;

use App\Filament\Clusters\KurtiSettings\Resources\KurtiButtonTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListKurtiButtonTypes extends ListRecords
{
    protected static string $resource = KurtiButtonTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
