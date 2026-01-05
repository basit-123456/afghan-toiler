<?php

namespace App\Filament\Clusters\WaskatSettings\Resources\WaskatDomanTypeResource\Pages;

use App\Filament\Clusters\WaskatSettings\Resources\WaskatDomanTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWaskatDomanType extends EditRecord
{
    protected static string $resource = WaskatDomanTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
