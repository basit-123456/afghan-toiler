<?php

namespace App\Filament\Resources\TailorProductResource\Pages;

use App\Filament\Resources\TailorProductResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTailorProducts extends ListRecords
{
    protected static string $resource = TailorProductResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
