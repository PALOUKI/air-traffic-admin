<?php

namespace App\Filament\Widgets;

use App\Models\Passager;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\ChartWidget;

class PassagerAdminChart extends ChartWidget
{
    protected static ?string $heading = 'Passagers chart';
    protected static string $color = 'warning';
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $data = Trend::model(Passager::class)
        ->between(
            start: now()->startOfMonth(),
            end: now()->endOfMonth(),
        )
        ->perDay()
        ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Passagers',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date)
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }
}
