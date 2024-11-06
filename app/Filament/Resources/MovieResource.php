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
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Parfaitementweb\FilamentCountryField\Forms\Components\Country;

class MovieResource extends Resource
{
    protected static ?string $model = Movie::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make(12)->schema([
                    Grid::make()->columnSpan(8)->schema([
                        TextInput::make('title')
                            ->columnSpanFull(),
                        TextInput::make('genre'),
                        DatePicker::make('release_date'),
                        TextInput::make('duration'),
                        TextInput::make('price'),
                        Toggle::make('is_available'),
                        RichEditor::make('description')
                            ->columnSpanFull(),
                    ]),
                    Grid::make()->columnSpan(4)
                        ->schema([
                            CuratorPicker::make('feature_image')
                                ->columnSpanFull(),
                            TextInput::make('trailer_url')
                                ->columnSpanFull()
                                ->url(),
                            TextInput::make('rating')
                                ->numeric()
                                ->inputMode('decimal'),
                            TextInput::make('language'),
                            Country::make('country')
                                ->searchable(),
                            TextInput::make('director'),
                            TextInput::make('views')
                                ->integer()->minValue(0),
                            KeyValue::make('cast')
                                ->label('Casts')
                                ->keyLabel('Name')
                                ->valueLabel('Profile Link')
                                ->columnSpanFull(),

                        ]),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                CuratorColumn::make('feature_image')
                    ->size(60)
                    ->circular(),
                Tables\Columns\TextColumn::make('title')
                    ->description(fn(Movie $movie) => $movie->genre),
                Tables\Columns\TextColumn::make('release_date')
                    ->date(),
                Tables\Columns\TextColumn::make('duration'),
                Tables\Columns\TextColumn::make('price')
                    ->money('UGX', true, true),
                Tables\Columns\IconColumn::make('is_available')
                    ->boolean(),
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
            'index' => Pages\ListMovies::route('/'),
            'create' => Pages\CreateMovie::route('/create'),
            'edit' => Pages\EditMovie::route('/{record}/edit'),
        ];
    }
}
