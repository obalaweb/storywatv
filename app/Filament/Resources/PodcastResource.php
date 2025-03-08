<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PodcastResource\Pages;
use App\Filament\Resources\PodcastResource\RelationManagers;
use App\Models\Podcast;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Components\Tables\CuratorColumn;
use Filament\Forms;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class PodcastResource extends Resource
{
    protected static ?string $model = Podcast::class;
    protected static ?string $navigationIcon = 'heroicon-o-microphone';
    protected static ?string $navigationGroup = 'Content';
    protected static ?int $navigationSort = 20;

    public static function getLabel(): string
    {
        return 'Podcast';
    }

    public static function getPluralLabel(): string
    {
        return 'Podcasts';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Podcast Content')
                    ->collapsible()
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn($state, callable $set) => $set('slug', Str::slug($state)))
                            ->columnSpanFull(),
                        TextInput::make('slug')
                            ->required()
                            ->unique(Podcast::class, 'slug', ignoreRecord: true)
                            ->maxLength(255)
                            ->helperText('Used for SEO-friendly URLs')
                            ->columnSpanFull(),
                        RichEditor::make('description')
                            ->required()
                            ->maxLength(5000)
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
                            ->columnSpanFull(),
                        TextInput::make('audio_url')
                            ->url()
                            ->required()
                            ->unique(Podcast::class, 'audio_url', ignoreRecord: true)
                            ->prefix('https://')
                            ->placeholder('soundcloud.com/...')
                            ->helperText('Enter the podcast audio URL')
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Metadata')
                    ->collapsible()
                    ->schema([
                        CuratorPicker::make('thumbnail')
                            ->label('Thumbnail')
                            ->relationship('media', 'id')
                            ->size('md')
                            ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/webp'])
                            ->default(fn() => url('/images/default-podcast.jpg'))
                            ->columnSpan(1),
                        Forms\Components\Grid::make(3)
                            ->columnSpan(2)
                            ->schema([
                                TextInput::make('host')
                                    ->maxLength(255)
                                    ->placeholder('John Doe'),
                                TextInput::make('duration')
                                    ->numeric()
                                    ->suffix('minutes')
                                    ->minValue(1)
                                    ->maxValue(999),
                                Select::make('status')
                                    ->options([
                                        'draft' => 'Draft',
                                        'published' => 'Published',
                                        'archived' => 'Archived',
                                    ])
                                    ->default('draft')
                                    ->native(false),
                                DateTimePicker::make('published_at')
                                    ->native(false)
                                    ->displayFormat('d/m/Y H:i')
                                    ->default(fn($operation) => $operation === 'create' ? now() : null),
                                Toggle::make('is_featured')
                                    ->label('Featured Podcast')
                                    ->default(false)
                                    ->inline(false),
                                TagsInput::make('tags')
                                    ->separator(',')
                                    ->suggestions(['interview', 'tech', 'news', 'education'])
                                    ->placeholder('Add tags...')
                                    ->columnSpanFull(),
                            ]),
                    ])
                    ->columns(3),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                CuratorColumn::make('thumbnail')
                    ->size(60)
                    ->rounded()
                    ->defaultImageUrl(url('/images/default-podcast.jpg')),
                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->description(fn(Podcast $record): string => Str::limit($record->audio_url, 30))
                    ->wrap(),
                TextColumn::make('host')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('duration')
                    ->formatStateUsing(fn($state) => "$state min")
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('status')
                    ->badge()
                    ->colors([
                        'gray' => 'draft',
                        'success' => 'published',
                        'warning' => 'archived',
                    ])
                    ->sortable(),
                TextColumn::make('published_at')
                    ->dateTime('d/m/Y')
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('views')
                    ->default(0)
                    ->sortable()
                    ->alignRight(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'draft' => 'Draft',
                        'published' => 'Published',
                        'archived' => 'Archived',
                    ]),
                SelectFilter::make('is_featured')
                    ->label('Featured')
                    ->options([
                        '1' => 'Yes',
                        '0' => 'No',
                    ]),
                Tables\Filters\Filter::make('published_at')
                    ->form([
                        DateTimePicker::make('from'),
                        DateTimePicker::make('until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['from'], fn(Builder $q, $date) => $q->where('published_at', '>=', $date))
                            ->when($data['until'], fn(Builder $q, $date) => $q->where('published_at', '<=', $date));
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
                    Tables\Actions\BulkAction::make('publish')
                        ->label('Publish Selected')
                        ->action(fn($records) => $records->each->update(['status' => 'published', 'published_at' => now()]))
                        ->requiresConfirmation()
                        ->icon('heroicon-o-check-circle'),
                    Tables\Actions\BulkAction::make('feature')
                        ->label('Toggle Featured')
                        ->action(fn($records) => $records->each->update(['is_featured' => fn($record) => !$record->is_featured]))
                        ->requiresConfirmation()
                        ->icon('heroicon-o-star'),
                ]),
            ])
            ->defaultSort('published_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            // Add relation managers if needed
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPodcasts::route('/'),
            'create' => Pages\CreatePodcast::route('/create'),
            // 'view' => Pages\ViewPodcast::route('/{record}'),
            'edit' => Pages\EditPodcast::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([SoftDeletingScope::class]);
    }
}
