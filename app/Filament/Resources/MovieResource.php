<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MovieResource\Pages;
use App\Filament\Resources\MovieResource\RelationManagers;
use App\Models\Movie;
use Awcodes\Curator\Components\Forms\CuratorPicker;
use Awcodes\Curator\Components\Tables\CuratorColumn;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Parfaitementweb\FilamentCountryField\Forms\Components\Country;

class MovieResource extends Resource
{
    protected static ?string $model = Movie::class;
    protected static ?string $navigationIcon = 'heroicon-o-film';
    protected static ?string $navigationGroup = 'Content';
    protected static ?int $navigationSort = 10;

    public static function getLabel(): string
    {
        return 'Movie';
    }

    public static function getPluralLabel(): string
    {
        return 'Movies';
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Basic Information')
                    ->collapsible()
                    ->schema([
                        Grid::make(12)
                            ->schema([
                                TextInput::make('title')
                                    ->required()
                                    ->maxLength(255)
                                    ->live(onBlur: true)
                                    ->afterStateUpdated(fn($state, callable $set) => $set('slug', Str::slug($state)))
                                    ->columnSpan(8),
                                TextInput::make('slug')
                                    ->required()
                                    ->unique(Movie::class, 'slug', ignoreRecord: true)
                                    ->maxLength(255)
                                    ->columnSpan(4),
                                Select::make('genre')
                                    ->options([
                                        'action' => 'Action',
                                        'comedy' => 'Comedy',
                                        'drama' => 'Drama',
                                        'horror' => 'Horror',
                                        'sci-fi' => 'Sci-Fi',
                                        'romance' => 'Romance',
                                    ])
                                    ->searchable()
                                    ->columnSpan(4),
                                DatePicker::make('release_date')
                                    ->native(false)
                                    ->displayFormat('d/m/Y')
                                    ->maxDate(now())
                                    ->columnSpan(4),
                                TextInput::make('duration')
                                    ->numeric()
                                    ->suffix('minutes')
                                    ->minValue(1)
                                    ->maxValue(999)
                                    ->columnSpan(4),
                                TextInput::make('price')
                                    ->numeric()
                                    ->prefix('UGX')
                                    ->minValue(0)
                                    ->step(100)
                                    ->columnSpan(4),
                                Toggle::make('is_available')
                                    ->label('Available for Viewing')
                                    ->inline(false)
                                    ->columnSpan(4),
                                RichEditor::make('description')
                                    ->toolbarButtons([
                                        'bold',
                                        'italic',
                                        'underline',
                                        'strike',
                                        'link',
                                        'orderedList',
                                        'bulletList',
                                    ])
                                    ->columnSpanFull(),
                            ]),
                    ]),

                Section::make('Media & Details')
                    ->collapsible()
                    ->schema([
                        Grid::make(12)
                            ->schema([
                                CuratorPicker::make('feature_image')
                                    ->label('Feature Image')
                                    ->size('md')
                                    ->columnSpan(4),
                                TextInput::make('trailer_url')
                                    ->label('Trailer URL')
                                    ->url()
                                    ->prefix('https://')
                                    ->placeholder('youtube.com/watch?v=...')
                                    ->columnSpan(8),
                                TextInput::make('rating')
                                    ->numeric()
                                    ->minValue(0)
                                    ->maxValue(10)
                                    ->step(0.1)
                                    ->suffix('/10')
                                    ->columnSpan(4),
                                TextInput::make('language')
                                    ->maxLength(100)
                                    ->columnSpan(4),
                                Country::make('country')
                                    ->searchable()
                                    ->columnSpan(4),
                                TextInput::make('director')
                                    ->maxLength(255)
                                    ->columnSpan(4),
                                TextInput::make('views')
                                    ->integer()
                                    ->minValue(0)
                                    ->default(0)
                                    ->disabled()
                                    ->columnSpan(4),
                                KeyValue::make('cast')
                                    ->label('Cast Members')
                                    ->keyLabel('Actor Name')
                                    ->valueLabel('Profile URL')
                                    ->addActionLabel('Add Cast Member')
                                    ->columnSpanFull(),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                CuratorColumn::make('feature_image')
                    ->size(60)
                    ->circular()
                    ->defaultImageUrl(url('/images/default-movie.jpg')),
                TextColumn::make('title')
                    ->searchable()
                    ->sortable()
                    ->description(fn(Movie $movie) => $movie->genre),
                TextColumn::make('release_date')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('duration')
                    ->formatStateUsing(fn($state) => "$state min")
                    ->sortable(),
                TextColumn::make('price')
                    ->money('UGX', divideBy: 1)
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_available')
                    ->boolean()
                    ->label('Available'),
                TextColumn::make('views')
                    ->sortable()
                    ->alignRight(),
            ])
            ->filters([
                SelectFilter::make('genre')
                    ->options([
                        'action' => 'Action',
                        'comedy' => 'Comedy',
                        'drama' => 'Drama',
                        'horror' => 'Horror',
                        'sci-fi' => 'Sci-Fi',
                        'romance' => 'Romance',
                    ]),
                TernaryFilter::make('is_available'),
                Tables\Filters\Filter::make('release_date')
                    ->form([
                        DatePicker::make('released_from'),
                        DatePicker::make('released_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['released_from'], fn(Builder $query, $date) => $query->whereDate('release_date', '>=', $date))
                            ->when($data['released_until'], fn(Builder $query, $date) => $query->whereDate('release_date', '<=', $date));
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
                    Tables\Actions\BulkAction::make('toggle_availability')
                        ->label('Toggle Availability')
                        ->action(fn($records) => $records->each->update(['is_available' => fn($record) => !$record->is_available]))
                        ->requiresConfirmation()
                        ->icon('heroicon-o-check-circle'),
                ]),
            ])
            ->defaultSort('release_date', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            // Add relation managers here if needed
            // e.g., RelationManagers\ReviewsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMovies::route('/'),
            'create' => Pages\CreateMovie::route('/create'),
            // 'view' => Pages\ViewMovie::route('/{record}'),
            'edit' => Pages\EditMovie::route('/{record}/edit'),
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
