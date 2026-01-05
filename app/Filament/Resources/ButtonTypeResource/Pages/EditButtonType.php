<?php

namespace App\Filament\Resources\ButtonTypeResource\Pages;

use App\Filament\Resources\ButtonTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditButtonType extends EditRecord
{
    protected static string $resource = ButtonTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
