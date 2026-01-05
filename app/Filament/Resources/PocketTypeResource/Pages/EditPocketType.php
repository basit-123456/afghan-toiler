<?php

namespace App\Filament\Resources\PocketTypeResource\Pages;

use App\Filament\Resources\PocketTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPocketType extends EditRecord
{
    protected static string $resource = PocketTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
