<?php

namespace App\Filament\Resources\CollerTypeResource\Pages;

use App\Filament\Resources\CollerTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCollerType extends EditRecord
{
    protected static string $resource = CollerTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
