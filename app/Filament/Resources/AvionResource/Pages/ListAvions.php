<?php

namespace App\Filament\Resources\AvionResource\Pages;

use App\Models\Avion;
use Filament\Actions;
use App\Filament\Resources\AvionResource;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\ListRecords\Tab;

class ListAvions extends ListRecords
{
    protected static string $resource = AvionResource::class;

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
                ->badge(Avion::query()->where('created_at', '>=', now()->subWeek())->count()),
            'Ce Mois' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('created_at', '>=', now()->subMonth()))
                ->badge(Avion::query()->where('created_at', '>=', now()->subMonth())->count()),
            'Cette Année' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('created_at', '>=', now()->subYear()))
                ->badge(Avion::query()->where('created_at', '>=', now()->subYear())->count()),
        ];
    }
}
