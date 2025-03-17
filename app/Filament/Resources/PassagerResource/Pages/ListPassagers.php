<?php

namespace App\Filament\Resources\PassagerResource\Pages;

use Filament\Actions;
use App\Models\Passager;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PassagerResource;
use Filament\Resources\Pages\ListRecords\Tab;

class ListPassagers extends ListRecords
{
    protected static string $resource = PassagerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTabs():array
    {
        return [

            'Tout'=> Tab::make(),
            'Cette Semaine' => Tab::make()
            ->modifyQueryUsing(fn(Builder $query) => $query->where('created_at', '>=', now()->subWeek()))
            ->badge(Passager::query()->where('created_at', '>=', now()->subWeek())->count()),
            'Ce mois' => Tab::make()
            ->modifyQueryUsing(fn(Builder $query) => $query->where('created_at', '>=', now()->subMonth()))
            ->badge(Passager::query()->where('created_at', '>=', now()->subMonth())->count()),
            'Cette année' => Tab::make()
            ->modifyQueryUsing(fn(Builder $query) => $query->where('created_at', '>=', now()->subYear()))
            ->badge(Passager::query()->where('created_at', '>=', now()->subYear())->count())
            
        ];

    }
}
