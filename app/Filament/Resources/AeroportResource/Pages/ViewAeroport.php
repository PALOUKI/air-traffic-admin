<?php

namespace App\Filament\Resources\AeroportResource\Pages;

use App\Filament\Resources\AeroportResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAeroport extends ViewRecord
{
    protected static string $resource = AeroportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
