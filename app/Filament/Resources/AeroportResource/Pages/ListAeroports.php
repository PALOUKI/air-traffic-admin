<?php

namespace App\Filament\Resources\AeroportResource\Pages;

use Filament\Actions;
use App\Models\Aeroport;

use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\AeroportResource;
use Filament\Resources\Pages\ListRecords\Tab;

class ListAeroports extends ListRecords
{
    protected static string $resource = AeroportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs():array
    {
        return [
            'Tout' => Tab::make(),
            'Cette semaine' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('created_at', '>=', now()->subWeek()))
                ->badge(Aeroport::query()->where('created_at', '>=', now()->subWeek())->count()),
            'Ce Mois' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('created_at', '>=', now()->subMonth()))
                ->badge(Aeroport::query()->where('created_at', '>=', now()->subMonth())->count()),
            'Cette Année' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('created_at', '>=', now()->subYear()))
                ->badge(Aeroport::query()->where('created_at', '>=', now()->subYear())->count()),
        ];
    }
}
