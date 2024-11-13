<?php

namespace App\Filament\Account\Resources\MyVideoResource\Pages;

use App\Filament\Account\Resources\MyVideoResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMyVideo extends CreateRecord
{
    protected static string $resource = MyVideoResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_id'] = auth()->id();
        $data['status'] = 'draft';
        $data['trending_score'] = 0;
        \Illuminate\Support\Facades\Cache::forget('index_videos');

        return $data;
    }
}
