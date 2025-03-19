<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VideoResource\Pages;
use App\Filament\Resources\VideoResource\RelationManagers;
use App\Models\Category;
use App\Models\User;
use App\Models\Video;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Components\Tables\CuratorColumn;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Forms\Get;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class VideoResource extends Resource
{
    protected static ?string $model = Video::class;
    protected static ?string $navigationGroup = 'Videos';
    protected static ?int $navigationSort = 1;
    protected static ?string $navigationIcon = 'untitledui-play';

    public static function getLabel(): string
    {
        return 'Video';
    }

    public static function getPluralLabel(): string
    {
        return 'Videos';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(12)->schema([
                    Grid::make()
                        ->columnSpan(7)
                        ->schema([
                            TextInput::make('title')
                                ->required()
                                ->maxLength(255)
                                ->live(onBlur: true)
                                ->afterStateUpdated(fn($state, callable $set) => $set('slug', Str::slug($state)))
                                ->columnSpanFull(),
                            TextInput::make('youtube_url')
                                ->required()
                                ->url()
                                ->unique(Video::class, 'youtube_url', ignoreRecord: true)
                                ->prefix('https://')
                                ->placeholder('youtube.com/watch?v=...')
                                ->helperText('Enter a valid YouTube URL')
                                ->rules(['regex:/^(https?:\/\/)?(www\.)?youtube\.com\/watch\?v=[\w-]{11}$/'])
                                ->live(onBlur: true) // Make the field reactive
                                ->afterStateUpdated(function ($state, callable $set) {
                                    // Extract YouTube ID from the URL
                                    $youtubeId = self::extractYoutubeId($state);
                                    if ($youtubeId) {
                                        $set('youtube_id', $youtubeId); // Set the youtube_id field
                                    }
                                })
                                ->columnSpanFull(),

                            Hidden::make('youtube_id')
                                ->required()
                                ->unique(Video::class, 'youtube_id', ignoreRecord: true),

                            RichEditor::make('description')
                                ->toolbarButtons([
                                    'bold',
                                    'italic',
                                    'underline',
                                    'strike',
                                    'link',
                                    'orderedList',
                                    'bulletList',
                                    'blockquote',
                                ])
                                ->maxLength(5000)
                                ->columnSpanFull(),
                        ]),
                    Grid::make()
                        ->columnSpan(5)
                        ->schema([
                            CuratorPicker::make('thumbnail_url')
                                ->label('Thumbnail')
                                ->size('md')
                                ->default(fn() => url('/images/default-video-thumb.jpg'))
                                ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                                ->columnSpanFull(),
                            Section::make('Metadata')
                                ->collapsible()
                                ->schema([
                                    Grid::make()
                                        ->schema([
                                            TextInput::make('duration')
                                                ->numeric()
                                                ->suffix('minutes')
                                                ->minValue(1)
                                                ->maxValue(999)
                                                ->helperText('Duration in minutes'),
                                            Select::make('user_id')
                                                ->label('Author')
                                                ->relationship('postBy', 'name')
                                                ->searchable()
                                                ->preload()
                                                ->required(),
                                            Select::make('category_id')
                                                ->label('Category')
                                                ->relationship('category', 'name')
                                                ->searchable()
                                                ->preload()
                                                ->required(),
                                            Select::make('status')
                                                ->options([
                                                    'draft' => 'Draft',
                                                    'active' => 'Published',
                                                    'archived' => 'Archived',
                                                ])
                                                ->default('draft')
                                                ->native(false),
                                            Select::make('is_trending')
                                                ->label('Trending')
                                                ->options([
                                                    true => 'Yes',
                                                    false => 'No',
                                                ])
                                                ->default(false)
                                                ->native(false),
                                            TextInput::make('trending_score')
                                                ->label('Trending Score (%)')
                                                ->numeric()
                                                ->minValue(0)
                                                ->maxValue(100)
                                                ->step(1)
                                                ->default(0),
                                            DateTimePicker::make('trending_since')
                                                ->native(false)
                                                ->displayFormat('d/m/Y H:i')
                                                ->hidden(fn($operation) => $operation === 'edit')
                                                ->disabled(),
                                            TagsInput::make('tags')
                                                ->separator(',')
                                                ->suggestions(['tutorial', 'review', 'trailer', 'vlog'])
                                                ->placeholder('Add tags...')
                                                ->columnSpanFull(),
                                            Toggle::make('is_featured')
                                                ->label('Featured Video')
                                                ->default(false)
                                                ->inline(false),
                                        ]),
                                ]),
                        ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                CuratorColumn::make('thumbnail_url')
                    ->label('Thumbnail')
                    ->size(70)
                    ->circular()
                    ->defaultImageUrl(url('/images/default-video-thumb.jpg')),
                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->description(fn(Video $video) => Str::limit($video->youtube_url, 30))
                    ->wrap(),
                TextColumn::make('duration')
                    ->formatStateUsing(fn($state) => "$state min")
                    ->sortable(),
                TextColumn::make('user.name')
                    ->label('Author')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('category.name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'gray' => 'draft',
                        'success' => 'active',
                        'warning' => 'archived',
                    ])
                    ->sortable(),
                IconColumn::make('is_trending')
                    ->label('Trending')
                    ->boolean()
                    ->sortable(),
                TextColumn::make('trending_score')
                    ->suffix('%')
                    ->sortable()
                    ->alignRight(),
                TextColumn::make('views')
                    ->label('Views')
                    ->sortable()
                    ->default(0)
                    ->alignRight(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'active' => 'Published',
                        'archived' => 'Archived',
                    ]),
                TernaryFilter::make('is_trending')
                    ->label('Trending Status'),
                SelectFilter::make('category')
                    ->relationship('category', 'name'),
                Tables\Filters\Filter::make('trending_since')
                    ->form([
                        DateTimePicker::make('from'),
                        DateTimePicker::make('until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['from'], fn(Builder $q, $date) => $q->where('trending_since', '>=', $date))
                            ->when($data['until'], fn(Builder $q, $date) => $q->where('trending_since', '<=', $date));
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\BulkAction::make('toggle_trending')
                        ->label('Toggle Trending')
                        ->action(fn($records) => $records->each->update(['is_trending' => fn($record) => !$record->is_trending]))
                        ->requiresConfirmation()
                        ->icon('heroicon-o-fire'),
                    Tables\Actions\BulkAction::make('publish')
                        ->label('Publish Selected')
                        ->action(fn($records) => $records->each->update(['status' => 'active']))
                        ->requiresConfirmation()
                        ->icon('heroicon-o-check-circle'),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            // Add relation managers if needed
        ];
    }

    // Helper method to extract YouTube ID
    protected static function extractYoutubeId($url): ?string
    {
        $pattern = '/^(?:https?:\/\/)?(?:www\.)?youtube\.com\/watch\?v=([\w-]{11})$/';
        if (preg_match($pattern, $url, $matches)) {
            return $matches[1]; // Return the 11-character video ID
        }
        return null; // Return null if no match
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVideos::route('/'),
            'create' => Pages\CreateVideo::route('/create'),
            // 'view' => Pages\ViewVideo::route('/{record}'),
            'edit' => Pages\EditVideo::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([SoftDeletingScope::class]);
    }
}
