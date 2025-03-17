<?php

namespace App\Filament\Resources\ControleAerienResource\Pages;

use App\Filament\Resources\ControleAerienResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewControleAerien extends ViewRecord
{
    protected static string $resource = ControleAerienResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
