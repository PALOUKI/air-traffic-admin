<?php

namespace App\Filament\Resources\PiloteResource\Pages;

use App\Filament\Resources\PiloteResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPilote extends EditRecord
{
    protected static string $resource = PiloteResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
