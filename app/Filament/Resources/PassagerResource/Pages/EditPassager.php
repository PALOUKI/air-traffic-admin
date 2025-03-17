<?php

namespace App\Filament\Resources\PassagerResource\Pages;

use App\Filament\Resources\PassagerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPassager extends EditRecord
{
    protected static string $resource = PassagerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
