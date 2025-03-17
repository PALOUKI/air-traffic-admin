<?php

namespace App\Filament\Resources\CompagnieAerienneResource\Pages;

use App\Filament\Resources\CompagnieAerienneResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewCompagnieAerienne extends ViewRecord
{
    protected static string $resource = CompagnieAerienneResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
