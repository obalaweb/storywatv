<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Exceptions\Halt;

class Setting extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    public ?array $data = [];

    protected static string $view = 'filament.pages.setting';

    public function mount(): void
    {
        $profile = \App\Models\Setting::first();
        if ($profile) {
            $this->form->fill($profile->toArray());
        } else {
            $this->form->fill();
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Grid::make()->schema([
                    TextInput::make('site_name')
                        ->name('Site Name')
                        ->required(),
                    TextInput::make('site_email')
                        ->name('Site Email'),
                    TextInput::make('site_phone')
                        ->name('Site Phone'),
                    Textarea::make('site_tagline')
                        ->name('Site Tagline'),
                    Textarea::make('address'),
                    TextInput::make('facebook_link')
                        ->url(),
                    TextInput::make('instagram_link')
                        ->url(),
                    TextInput::make('twitter_link')
                        ->url(),
                    TextInput::make('google_analytics_id'),
                ]),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
                ->submit('save'),
        ];
    }

    public function save(): void
    {

        try {
            $data = $this->form->getState();
            $profile = \App\Models\Setting::first();
            if ($profile) {
                $profile->update($data);
            } else {
                \App\Models\Setting::create($data);
            }
        } catch (Halt $exception) {
            return;
        }

        Notification::make()
            ->success()
            ->title(__('Settings Updated successfully'))
            ->send();
    }
}
