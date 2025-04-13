<?php

namespace App\Filament\Widgets;

use App\Models\Video;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class ScheduledVideosChart extends ChartWidget
{
    protected static ?string $heading = 'Scheduled Videos Timeline';
    protected static ?string $maxHeight = '300px';
    protected int | string | array $columnSpan = 2;

    protected function getData(): array
    {
        $scheduledVideos = Video::where('is_scheduled', true)
            ->select(
                DB::raw('DATE(scheduled_start_time) as date'),
                DB::raw('COUNT(*) as count')
            )
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return [
            'datasets' => [
                [
                    'label' => 'Scheduled Videos',
                    'data' => $scheduledVideos->pluck('count')->toArray(),
                    'backgroundColor' => '#f59e0b',
                    'borderColor' => '#d97706',
                    'tension' => 0.4,
                ],
            ],
            'labels' => $scheduledVideos->pluck('date')->toArray(),
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'stepSize' => 1,
                    ],
                ],
            ],
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
        ];
    }
}
