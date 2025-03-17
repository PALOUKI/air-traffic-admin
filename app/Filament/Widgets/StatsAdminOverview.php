<?php

namespace App\Filament\Widgets;

use App\Models\Aeroport;
use App\Models\Avion;
use App\Models\CompagnieAerienne;
use App\Models\Passager;
use App\Models\Pilote;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsAdminOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Compagnies aérienne', CompagnieAerienne::query()->count())
                ->description('Toutes les compagnies')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 10, 10, 3, 15, 4, 17])
                ->color('yellow'),
            Stat::make('Aeroports', Aeroport::query()->count())
                ->description('Tous les aéroports')
                ->descriptionIcon('heroicon-m-arrow-trending-down')
                ->chart([7, 17, 10, 15, 3, 10, 4])
                ->color('danger'),
            Stat::make('Avions', Avion::query()->count())
                ->description('Tous les avions')
                ->descriptionIcon('heroicon-m-arrow-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
        ];
    }
}
