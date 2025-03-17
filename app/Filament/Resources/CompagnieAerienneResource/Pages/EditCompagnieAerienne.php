<?php

namespace App\Filament\Resources\CompagnieAerienneResource\Pages;

use App\Filament\Resources\CompagnieAerienneResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCompagnieAerienne extends EditRecord
{
    protected static string $resource = CompagnieAerienneResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
