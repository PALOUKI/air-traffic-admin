<?php

namespace App\Filament\Resources\AvionResource\Pages;

use App\Filament\Resources\AvionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAvion extends EditRecord
{
    protected static string $resource = AvionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
