<?php

namespace App\Filament\Resources\TrouserTypeResource\Pages;

use App\Filament\Resources\TrouserTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTrouserType extends EditRecord
{
    protected static string $resource = TrouserTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
