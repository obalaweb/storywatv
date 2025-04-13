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
use Filament\Forms\Components\DateTimePicker;
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
                Section::make()
                    ->schema([
                        Grid::make(12)
                            ->schema([
                                TextInput::make('name')
                                    ->columnSpan(6)
                                    ->required(),
                                TextInput::make('email')
                                    ->columnSpan(6)
                                    ->email()
                                    ->required(),
                                TextInput::make('subject')
                                    ->columnSpanFull()
                                    ->required(),
                                Textarea::make('message')
                                    ->columnSpanFull()
                                    ->required(),
                                Toggle::make('status')
                                    ->label("Read")
                                    ->columnSpanFull()
                                    ->disabled(),
                            ]),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->limit(60)
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('subject')
                    ->limit(50)
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('created_at')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(),
                ToggleColumn::make('status')
                    ->label('Read')
                    ->sortable(),
            ])
            ->filters([
                Tables\Filters\Filter::make('unread')
                    ->query(fn(Builder $query): Builder => $query->where('status', false))
                    ->label('Unread Messages'),
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        DateTimePicker::make('from')
                            ->native(false),
                        DateTimePicker::make('until')
                            ->native(false),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when($data['from'], fn(Builder $q, $date) => $q->where('created_at', '>=', $date))
                            ->when($data['until'], fn(Builder $q, $date) => $q->where('created_at', '<=', $date));
                    }),
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
                    Tables\Actions\BulkAction::make('mark_as_read')
                        ->label('Mark as Read')
                        ->action(fn($records) => $records->each->update(['status' => true]))
                        ->requiresConfirmation()
                        ->icon('heroicon-o-check-circle'),
                ]),
            ])
            ->defaultSort('created_at', 'desc')
            ->persistFiltersInSession()
            ->persistSearchInSession()
            ->persistColumnSearchesInSession();
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

    public static function getNavigationGroup(): ?string
    {
        return 'System';
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
