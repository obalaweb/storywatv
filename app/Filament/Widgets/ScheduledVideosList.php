<?php

namespace App\Filament\Widgets;

use App\Models\Video;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class ScheduledVideosList extends BaseWidget
{
    protected static ?string $heading = 'Upcoming Scheduled Videos';
    protected int | string | array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Video::query()
                    ->where('is_scheduled', true)
                    ->where('scheduled_start_time', '>', now())
                    ->orderBy('scheduled_start_time')
                    ->limit(5)
            )
            ->columns([
                Tables\Columns\ImageColumn::make('thumbnail_url')
                    ->label('Thumbnail')
                    ->circular()
                    ->size(40),
                Tables\Columns\TextColumn::make('title')
                    ->searchable()
                    ->limit(30)
                    ->tooltip(function (Tables\Columns\TextColumn $column): ?string {
                        $state = $column->getState();
                        if (strlen($state) <= 30) {
                            return null;
                        }
                        return $state;
                    }),
                Tables\Columns\TextColumn::make('scheduled_start_time')
                    ->label('Start Time')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('scheduled_end_time')
                    ->label('End Time')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('play_order')
                    ->label('Order')
                    ->sortable()
                    ->alignRight(),
            ])
            ->actions([
                Tables\Actions\Action::make('view')
                    ->url(fn(Video $record): string => route('filament.admin.resources.videos.view', ['record' => $record]))
                    ->openUrlInNewTab(),
            ])
            ->defaultSort('scheduled_start_time', 'asc');
    }
}
