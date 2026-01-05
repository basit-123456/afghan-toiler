<?php

namespace App\Filament\Clusters\KurtiSettings\Resources\KurtiButtonTypeResource\Pages;

use App\Filament\Clusters\KurtiSettings\Resources\KurtiButtonTypeResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditKurtiButtonType extends EditRecord
{
    protected static string $resource = KurtiButtonTypeResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
