<?php

namespace App\Filament\Resources\VolResource\Pages;

use App\Models\Vol;
use Filament\Actions;
use App\Filament\Resources\VolResource;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\ListRecords\Tab;


class ListVols extends ListRecords
{
    protected static string $resource = VolResource::class;

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
                ->badge(Vol::query()->where('created_at', '>=', now()->subWeek())->count()),
            'Ce Mois' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('created_at', '>=', now()->subMonth()))
                ->badge(Vol::query()->where('created_at', '>=', now()->subMonth())->count()),
            'Cette Année' => Tab::make()
                ->modifyQueryUsing(fn(Builder $query) => $query->where('created_at', '>=', now()->subYear()))
                ->badge(Vol::query()->where('created_at', '>=', now()->subYear())->count()),
        ];
    }
}
