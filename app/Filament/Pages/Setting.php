<?php

namespace App\Filament\Pages;

use Filament\Actions\Action;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Support\Exceptions\Halt;
use Illuminate\Validation\ValidationException;

class Setting extends Page implements HasForms
{
    use InteractsWithForms;

    protected static ?string $navigationIcon = 'heroicon-o-cog-6-tooth';
    protected static ?string $navigationGroup = 'System';
    protected static ?int $navigationSort = 100;

    public ?array $data = [];
    protected static string $view = 'filament.pages.setting';

    public static function getNavigationLabel(): string
    {
        return __('Settings');
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('viewSite')
                ->label('View Site')
                ->url('/')
                ->openUrlInNewTab()
                ->color('gray'),
        ];
    }

    public function mount(): void
    {
        $profile = \App\Models\Setting::first();
        $this->form->fill($profile?->toArray() ?? []);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('General Settings')
                    ->collapsible()
                    ->schema([
                        Grid::make(2) // 2 columns
                            ->schema([
                                TextInput::make('site_name')
                                    ->label('Site Name')
                                    ->required()
                                    ->maxLength(255)
                                    ->autofocus(),
                                TextInput::make('site_email')
                                    ->label('Site Email')
                                    ->email()
                                    ->maxLength(255),
                                TextInput::make('site_phone')
                                    ->label('Site Phone')
                                    ->tel()
                                    ->mask('(999) 999-9999')
                                    ->placeholder('(123) 456-7890'),
                                Textarea::make('site_tagline')
                                    ->label('Site Tagline')
                                    ->maxLength(500)
                                    ->rows(3),
                            ]),
                    ]),

                Section::make('Contact Information')
                    ->collapsible()
                    ->schema([
                        Textarea::make('address')
                            ->label('Address')
                            ->rows(4),
                    ]),

                Section::make('Social Media')
                    ->collapsible()
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextInput::make('facebook_link')
                                    ->label('Facebook URL')
                                    ->url()
                                    ->prefix('https://')
                                    ->placeholder('facebook.com/username'),
                                TextInput::make('instagram_link')
                                    ->label('Instagram URL')
                                    ->url()
                                    ->prefix('https://')
                                    ->placeholder('instagram.com/username'),
                                TextInput::make('twitter_link')
                                    ->label('Twitter URL')
                                    ->url()
                                    ->prefix('https://')
                                    ->placeholder('twitter.com/username'),
                            ]),
                    ]),

                Section::make('Analytics')
                    ->collapsible()
                    ->schema([
                        TextInput::make('google_analytics_id')
                            ->label('Google Analytics ID')
                            ->placeholder('UA-XXXXX-Y')
                            ->helperText('Enter your Google Analytics tracking ID'),
                    ]),
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label(__('Save Settings'))
                ->submit('save')
                ->keyBindings(['mod+s']),
            Action::make('cancel')
                ->label(__('Cancel'))
                ->action(fn() => redirect()->route('filament.admin.pages.dashboard'))
                ->color('gray'),
        ];
    }

    public function save(): void
    {
        try {
            $this->authorize('update-settings');

            $data = $this->form->getState();

            \App\Models\Setting::updateOrCreate(
                ['id' => 1], // Assuming single settings record
                $data
            );

            Notification::make()
                ->title(__('Settings Saved'))
                ->body(__('Your site settings have been successfully updated.'))
                ->success()
                ->send();

        } catch (ValidationException $e) {
            Notification::make()
                ->title(__('Validation Error'))
                ->body(__('Please check the form for errors.'))
                ->danger()
                ->send();
            throw $e;
        } catch (\Exception $e) {
            Notification::make()
                ->title(__('Error'))
                ->body(__('An error occurred while saving settings: ') . $e->getMessage())
                ->danger()
                ->persistent()
                ->send();
        }
    }

    protected function getSavedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title(__('Settings Saved'))
            ->body(__('Changes have been successfully saved.'));
    }
}
