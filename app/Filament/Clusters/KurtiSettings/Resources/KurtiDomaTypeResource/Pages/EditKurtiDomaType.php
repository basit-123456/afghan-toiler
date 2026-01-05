<?php

namespace App\Filament\Clusters\KurtiSettings\Resources\KurtiDomaTypeResource\Pages;

use App\Filament\Clusters\KurtiSettings\Resources\KurtiDomaTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKurtiDomaType extends EditRecord
{
    protected static string $resource = KurtiDomaTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
