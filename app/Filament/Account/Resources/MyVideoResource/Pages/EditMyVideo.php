<?php

namespace App\Filament\Account\Resources\MyVideoResource\Pages;

use App\Filament\Account\Resources\MyVideoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMyVideo extends EditRecord
{
    protected static string $resource = MyVideoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['user_id'] = auth()->id();

        \Illuminate\Support\Facades\Cache::forget('index_videos');
        return $data;
    }
}
