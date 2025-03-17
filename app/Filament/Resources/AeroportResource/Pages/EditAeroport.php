<?php

namespace App\Filament\Resources\AeroportResource\Pages;

use App\Filament\Resources\AeroportResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAeroport extends EditRecord
{
    protected static string $resource = AeroportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
