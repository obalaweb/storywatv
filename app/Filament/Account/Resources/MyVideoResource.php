<?php

namespace App\Filament\Account\Resources;

use App\Filament\Account\Resources\MyVideoResource\Pages;
use App\Filament\Account\Resources\MyVideoResource\Pages\EditMyVideo;
use App\Filament\Account\Resources\MyVideoResource\RelationManagers;
use App\Filament\Resources\VideoResource\Pages\EditVideo;
use App\Models\Category;
use App\Models\Video;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Components\Tables\CuratorColumn;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MyVideoResource extends Resource
{
    protected static ?string $model = Video::class;

    protected static ?string $navigationLabel = "My Videos";
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(12)->schema([
                    Grid::make()
                        ->columnSpan(7)->schema([
                                TextInput::make('title')->columnSpanFull(),
                                TextInput::make('youtube_url')
                                    ->required()
                                    ->unique(ignoreRecord: true)
                                    ->url(),
                                TextInput::make('youtube_id')
                                    ->unique(ignoreRecord: true)
                                    ->required(),
                                RichEditor::make('description')->columnSpanFull(),
                            ]),
                    Grid::make()->columnSpan(5)->schema([
                        CuratorPicker::make('thumbnail_url')
                            ->columnSpanFull(),
                        TextInput::make('duration'),
                        Select::make('category_id')
                            ->label('Category')
                            ->options(Category::all()->pluck('name', 'id'))
                            ->columnSpanFull()
                            ->searchable(),
                        DateTimePicker::make('trending_since')
                            ->columnSpanFull()
                            ->hidden(class_exists(EditVideo::class)),
                    ]),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->modifyQueryUsing(fn(Video $video) => $video->where('user_id', auth()->id()))
            ->columns([
                CuratorColumn::make('thumbnail_url')
                    ->name('Thumbnail')
                    ->size(70),
                TextColumn::make('title')
                    ->description(fn(Video $video) => $video->youtube_url)
                    ->searchable(),
                TextColumn::make('duration')->searchable(),
                TextColumn::make('postBy.name')->searchable(),
                TextColumn::make('category.name')->searchable(),
                TextColumn::make('status')->searchable(),
                IconColumn::make('is_trending')
                    ->boolean()
                    ->sortable(),
                TextColumn::make('trending_score')->searchable(),
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
            'index' => Pages\ListMyVideos::route('/'),
            'create' => Pages\CreateMyVideo::route('/create'),
            'edit' => Pages\EditMyVideo::route('/{record}/edit'),
        ];
    }
}
