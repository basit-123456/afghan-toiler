<?php

namespace App\Filament\Resources\AsitinTypeResource\Pages;

use App\Filament\Resources\AsitinTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAsitinType extends EditRecord
{
    protected static string $resource = AsitinTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
