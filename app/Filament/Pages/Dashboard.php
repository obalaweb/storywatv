<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\ScheduledVideosChart;
use App\Filament\Widgets\VideoStatsOverview;
use App\Filament\Widgets\LatestVideos;
use App\Filament\Widgets\TrendingVideos;
use App\Filament\Widgets\ScheduledVideosList;
use Filament\Pages\Dashboard as BasePage;

class Dashboard extends BasePage
{
    protected static ?string $navigationIcon = 'heroicon-o-home';
    protected static ?string $navigationLabel = 'Dashboard';
    protected static ?string $title = 'Storywa.tv Dashboard';
    protected static ?string $slug = 'dashboard';

    protected function getHeaderWidgets(): array
    {
        return [
            VideoStatsOverview::class,
        ];
    }

    protected function getFooterWidgets(): array
    {
        return [];
    }

    // Change this from public to protected
    public function getWidgets(): array
    {
        return [
            ScheduledVideosChart::class,
            LatestVideos::class,
            TrendingVideos::class,
            ScheduledVideosList::class,
        ];
    }
}
