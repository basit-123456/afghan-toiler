<?php

namespace App\Filament\Clusters\WaskatSettings\Resources\WaskatCollarTypeResource\Pages;

use App\Filament\Clusters\WaskatSettings\Resources\WaskatCollarTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditWaskatCollarType extends EditRecord
{
    protected static string $resource = WaskatCollarTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
