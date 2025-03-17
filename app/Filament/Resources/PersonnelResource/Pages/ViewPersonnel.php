<?php

namespace App\Filament\Resources\PersonnelResource\Pages;

use App\Filament\Resources\PersonnelResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPersonnel extends ViewRecord
{
    protected static string $resource = PersonnelResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
