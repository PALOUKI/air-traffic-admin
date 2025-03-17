<?php

namespace App\Filament\Resources\ControleAerienResource\Pages;

use Filament\Actions;
use App\Models\ControleAerien;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\ListRecords\Tab;
use App\Filament\Resources\ControleAerienResource;

class ListControleAeriens extends ListRecords
{
    protected static string $resource = ControleAerienResource::class;

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
            ->badge(ControleAerien::query()->where('created_at', '>=', now()->subWeek())->count()),
            'Ce Mois' => Tab::make()
            ->modifyQueryUsing(fn(Builder $query) => $query->where('created_at', '>=', now()->subMonth()))
            ->badge(ControleAerien::query()->where('created_at', '>=', now()->subMonth())->count()),
            'Cette Année' => Tab::make()
            ->modifyQueryUsing(fn(Builder $query) => $query->where('created_at', '>=', now()->subYear()))
            ->badge(ControleAerien::query()->where('created_at', '>=', now()->subYear())->count()),
        ];
    }
}
