<?php

namespace App\Filament\Resources\PiloteResource\Pages;

use Filament\Actions;
use App\Models\Pilote;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PiloteResource;
use Filament\Resources\Pages\ListRecords\Tab;

class ListPilotes extends ListRecords
{
    protected static string $resource = PiloteResource::class;

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
            'Cette Semaine' => Tab::make()
            ->modifyQueryUsing(fn(Builder $query) => $query->where('created_at', '>=', now()->subWeek()))
            ->badge(Pilote::query()->where('created_at', '>=', now()->subWeek())->count()),
            'Ce Mois' => Tab::make()
            ->modifyQueryUsing(fn(Builder $query) => $query->where('created_at', '>=', now()->subMonth()))
            ->badge(Pilote::query()->where('created_at', '>=', now()->subMonth())->count()),
            'Cette Année' => Tab::make()
            ->modifyQueryUsing(fn(Builder $query) => $query->where('created_at', '>=', now()->subYear()))
            ->badge(Pilote::query()->where('created_at', '>=', now()->subYear())->count()),
        ];
    }
}
