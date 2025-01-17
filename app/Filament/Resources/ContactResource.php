<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ContactResource\Pages;
use App\Filament\Resources\ContactResource\RelationManagers;
use App\Filament\Resources\ContactResource\Widgets\MessageCart;
use App\Models\Contact;
use Filament\Forms;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $label = "Message";
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make()->schema([
                    Grid::make(12)->schema([
                        Grid::make()->columnSpan(6)->schema([
                            TextInput::make('name')
                                ->columnSpanFull(),
                        ]),
                        Grid::make()->columnSpan(6)->schema([
                            TextInput::make('email')
                                ->columnSpanFull(),
                        ]),
                    ]),
                    TextInput::make('subject'),
                    Textarea::make('message'),
                    Toggle::make('status')
                        ->label("Read")
                        ->columnSpanFull(),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->limit(60),
                TextColumn::make('email'),
                ToggleColumn::make('status')
                    ->label('Read')
            ])
            ->filters([
                //
            ])
            ->modifyQueryUsing(fn(Builder $query) => $query->latest())
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make()->modal(),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getWidgets(): array
    {
        return [
            MessageCart::class,
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::unread()->count() . " Unread";
    }

    public static function getNavigationBadgeColor(): ?string
    {
        return static::getModel()::unread()->count() > 0 ? 'success' : 'warning';
    }

    public static function getPages(): array
    {
        return [
            // 'index' => Pages\ManageContacts::route('/'),
            // 'view'  => Pages\ViewContact::route('/{record}'),

            'index' => Pages\ListContacts::route('/'),
        ];
    }
}
