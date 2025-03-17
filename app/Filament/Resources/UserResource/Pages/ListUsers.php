<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Models\User;
use Filament\Actions;
use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\ListRecords\Tab;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

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
            ->badge(User::query()->where('created_at', '>=', now()->subWeek())->count()),
            'Ce Mois' => Tab::make()
            ->modifyQueryUsing(fn(Builder $query) => $query->where('created_at', '>=', now()->subMonth()))
            ->badge(User::query()->where('created_at', '>=', now()->subMonth())->count()),
            'Cette Année' => Tab::make()
            ->modifyQueryUsing(fn(Builder $query) => $query->where('created_at', '>=', now()->subYear()))
            ->badge(User::query()->where('created_at', '>=', now()->subYear())->count()),
        ];
    }
}
