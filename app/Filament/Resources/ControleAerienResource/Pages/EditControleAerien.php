<?php

namespace App\Filament\Resources\ControleAerienResource\Pages;

use App\Filament\Resources\ControleAerienResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditControleAerien extends EditRecord
{
    protected static string $resource = ControleAerienResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ViewAction::make(),
            Actions\DeleteAction::make(),
        ];
    }
}
