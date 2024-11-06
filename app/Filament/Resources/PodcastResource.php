<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PodcastResource\Pages;
use App\Filament\Resources\PodcastResource\RelationManagers;
use App\Models\Podcast;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Components\Tables\CuratorColumn;
use Awcodes\Curator\CuratorPlugin;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PodcastResource extends Resource
{
    protected static ?string $model = Podcast::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(components: [
                Grid::make(12)->schema([
                    Grid::make()->columnSpan(8)->schema([
                        TextInput::make('title')
                            ->columnSpanFull()
                            ->required(),
                        RichEditor::make('description')
                            ->required()
                            ->columnSpanFull(),
                    ]),
                    Grid::make()->columnSpan(1)->schema([]),
                    Grid::make()->columnSpan(3)->schema([
                        CuratorPicker::make('thumbnail')
                            ->relationship('media', 'id'),
                        TextInput::make('host')
                            ->columnSpanFull(),
                        TextInput::make('audio_url')
                            ->url()
                            ->columnSpanFull()
                            ->required(),
                    ]),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                CuratorColumn::make('thumbnail')
                    ->size(60)
                    ->rounded(),
                TextColumn::make('title')
                    ->description(fn(Podcast $record): string => $record->audio_url)
                    ->searchable()
                    ->wrap()
                    ->limit()
                    ->sortable(),
                TextColumn::make('host')
                    ->searchable()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPodcasts::route('/'),
            'create' => Pages\CreatePodcast::route('/create'),
            'edit' => Pages\EditPodcast::route('/{record}/edit'),
        ];
    }
}
