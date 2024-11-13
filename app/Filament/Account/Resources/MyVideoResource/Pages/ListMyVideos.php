<?php

namespace App\Filament\Account\Resources\MyVideoResource\Pages;

use App\Filament\Account\Resources\MyVideoResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListMyVideos extends ListRecords
{
    protected static string $resource = MyVideoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
