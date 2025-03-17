<?php

namespace App\Filament\Resources\CompagnieAerienneResource\Pages;

use Filament\Actions;
use App\Models\CompagnieAerienne;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;

use Filament\Resources\Pages\ListRecords\Tab;
use App\Filament\Resources\CompagnieAerienneResource;

class ListCompagnieAeriennes extends ListRecords
{
    protected static string $resource = CompagnieAerienneResource::class;

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
                ->badge(CompagnieAerienne::query()->where('created_at', '>=', now()->subWeek())->count()),
            'Ce Mois' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('created_at', '>=', now()->subMonth()))
                ->badge(CompagnieAerienne::query()->where('created_at', '>=', now()->subMonth())->count()),
            'Cette Année' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('created_at', '>=', now()->subYear()))
                ->badge(CompagnieAerienne::query()->where('created_at', '>=', now()->subYear())->count()),
        ];
    }
}
