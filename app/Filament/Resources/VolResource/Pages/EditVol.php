<?php

namespace App\Filament\Resources\VolResource\Pages;

use App\Filament\Resources\VolResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVol extends EditRecord
{
    protected static string $resource = VolResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
