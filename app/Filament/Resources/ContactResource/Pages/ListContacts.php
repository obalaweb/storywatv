<?php

namespace App\Filament\Resources\ContactResource\Pages;

use App\Filament\Resources\ContactResource;
use App\Filament\Resources\ContactResource\Widgets\MessageCart;
use App\Models\Contact;
use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;

class ListContacts extends ListRecords
{
    protected static string $resource = ContactResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),

        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            MessageCart::class,
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make('All'),
            'published' => Tab::make('Read')
                ->modifyQueryUsing(function ($query) {
                    $query->read();
                })
                ->icon('heroicon-o-check-badge'),
            'pending' => Tab::make('Unread')
                ->modifyQueryUsing(function ($query) {
                    $query->unread();
                })
                ->icon('heroicon-o-clock'),
        ];
    }
}
