<?php

namespace App\Filament\Resources\PersonnelResource\Pages;

use Filament\Actions;
use App\Models\Personnel;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PersonnelResource;
use Filament\Resources\Pages\ListRecords\Tab;

class ListPersonnels extends ListRecords
{
    protected static string $resource = PersonnelResource::class;

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
            ->badge(Personnel::query()->where('created_at', '>=', now()->subWeek())->count()),
            'Ce Mois' => Tab::make()
            ->modifyQueryUsing(fn(Builder $query) => $query->where('created_at', '>=', now()->subMonth()))
            ->badge(Personnel::query()->where('created_at', '>=', now()->subMonth())->count()),
            'Cette année' => Tab::make()
            ->modifyQueryUsing(fn(builder $query) => $query->where('created_at', '>=', now()->subYear()))
            ->badge(Personnel::query()->where('created_at', '>=', now()->subYear())->count()),
        ];

    }
}
