<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VideoResource\Pages;
use App\Filament\Resources\VideoResource\Pages\EditVideo;
use App\Filament\Resources\VideoResource\RelationManagers;
use App\Models\Category;
use App\Models\User;
use App\Models\Video;
use Awcodes\Curator\Components\Forms\CuratorPicker;
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

class VideoResource extends Resource
{
    protected static ?string $model = Video::class;

    protected static ?string $navigationGroup = 'Videos';

    protected static ?int $navigationSort = 1;
    protected static ?string $navigationIcon = 'untitledui-play';

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
                                    ->url(),
                                TextInput::make('youtube_id')
                                    ->required(),
                                RichEditor::make('description')->columnSpanFull(),
                            ]),
                    Grid::make()->columnSpan(5)->schema([
                        CuratorPicker::make('thumbnail_url')
                            ->columnSpanFull(),
                        CuratorPicker::make('feature_image')
                            ->relationship('thumbnail', 'id')
                            ->columnSpanFull(),
                        TextInput::make('duration'),
                        Select::make('user_id')
                            ->label('Author')
                            ->options(User::all()->pluck('name', 'id'))
                            ->searchable(),
                        Select::make('category_id')
                            ->label('Category')
                            ->options(Category::all()->pluck('name', 'id'))
                            ->searchable(),
                        Select::make('status')
                            ->options([
                                'draft' => 'Draft',
                                'active' => 'Published',
                                'archived' => 'Archived',
                            ])->native(false),
                        Select::make('is_trending')->options([
                            true => 'Yes',
                            false => 'No',
                        ])->native(false),
                        TextInput::make('trending_score')
                            ->label('Trending Score (%)')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(100),
                        DateTimePicker::make('trending_since')->hidden(class_exists(EditVideo::class)),
                    ]),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
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
            'index' => Pages\ListVideos::route('/'),
            'create' => Pages\CreateVideo::route('/create'),
            'edit' => Pages\EditVideo::route('/{record}/edit'),
        ];
    }
}
