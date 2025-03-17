<?php

namespace App\Filament\Widgets;

use App\Models\Personnel;
use Flowframe\Trend\Trend;
use Flowframe\Trend\TrendValue;
use Filament\Widgets\ChartWidget;

class PersonnelAdminChart extends ChartWidget
{
    protected static ?string $heading = 'Personnels chart';
    protected static string $color = 'info';
    protected static ?int $sort = 1;

    protected function getData(): array
    {
        $data = Trend::model(Personnel::class)
        ->between(
            start: now()->startOfMonth(),
            end: now()->endOfMonth(),
        )
        ->perDay()
        ->count();

        return [
            'datasets' => [
                [
                    'label' => 'Personnels',
                    'data' => $data->map(fn (TrendValue $value) => $value->aggregate),
                ],
            ],
            'labels' => $data->map(fn (TrendValue $value) => $value->date)
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }
}
