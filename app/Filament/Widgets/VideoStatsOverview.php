<?php

namespace App\Filament\Widgets;

use App\Models\Video;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class VideoStatsOverview extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected function getStats(): array
    {
        return [
            Stat::make('Total Videos', Video::count())
                ->description('All videos in the system')
                ->descriptionIcon('heroicon-o-video-camera')
                ->color('success'),
            Stat::make('Scheduled Videos', Video::where('is_scheduled', true)->count())
                ->description('Videos in the schedule')
                ->descriptionIcon('heroicon-o-clock')
                ->color('warning'),
            Stat::make('Featured Videos', Video::where('is_featured', true)->count())
                ->description('Featured content')
                ->descriptionIcon('heroicon-o-star')
                ->color('info'),
            Stat::make('Trending Videos', Video::where('is_trending', true)->count())
                ->description('Currently trending')
                ->descriptionIcon('heroicon-o-fire')
                ->color('danger'),
        ];
    }
}
