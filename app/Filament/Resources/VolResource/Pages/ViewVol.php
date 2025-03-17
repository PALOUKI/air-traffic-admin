<?php

namespace App\Filament\Resources\VolResource\Pages;

use App\Filament\Resources\VolResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewVol extends ViewRecord
{
    protected static string $resource = VolResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
