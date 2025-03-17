<?php

namespace App\Filament\Widgets;

use App\Models\Vol;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\ChartWidget;

class VolAdminChart extends ChartWidget
{
    protected static ?string $heading = 'Vols chart';
    protected static string $color = 'warning';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $data = Trend::model(Vol::class)
        ->between(
            start: now()->startOfMonth(),
            end: now()->endOfMonth(),
        )
        ->perDay()
        ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Vols',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date)
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
