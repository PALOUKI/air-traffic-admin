<?php

namespace App\Filament\Resources\PassagerResource\Pages;

use App\Filament\Resources\PassagerResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPassager extends ViewRecord
{
    protected static string $resource = PassagerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
