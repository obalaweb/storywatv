<?php

namespace App\Filament\Widgets;

use App\Models\Video;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class TrendingVideos extends BaseWidget
{
    protected static ?string $heading = 'Trending Videos';
    protected int | string | array $columnSpan = 2;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Video::query()
                    ->where('is_trending', true)
                    ->orderBy('trending_score', 'desc')
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
                Tables\Columns\TextColumn::make('trending_score')
                    ->label('Trending Score')
                    ->suffix('%')
                    ->sortable()
                    ->alignRight(),
                Tables\Columns\TextColumn::make('trending_since')
                    ->dateTime('d/m/Y H:i')
                    ->sortable(),
                Tables\Columns\TextColumn::make('views')
                    ->sortable()
                    ->alignRight(),
            ])
            ->actions([
                Tables\Actions\Action::make('edit')
                    ->url(fn(Video $record): string => route('filament.admin.resources.videos.edit', ['record' => $record]))
            ])
            ->defaultSort('trending_score', 'desc');
    }
}
