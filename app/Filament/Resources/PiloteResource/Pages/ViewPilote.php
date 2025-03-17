<?php

namespace App\Filament\Resources\PiloteResource\Pages;

use App\Filament\Resources\PiloteResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPilote extends ViewRecord
{
    protected static string $resource = PiloteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
