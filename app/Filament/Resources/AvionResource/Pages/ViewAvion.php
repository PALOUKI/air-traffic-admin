<?php

namespace App\Filament\Resources\AvionResource\Pages;

use App\Filament\Resources\AvionResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAvion extends ViewRecord
{
    protected static string $resource = AvionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
