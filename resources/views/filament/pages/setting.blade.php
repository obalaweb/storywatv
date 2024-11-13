<x-filament-panels::page>
    <x-filament-panels::form wire:submit="save">
        <div class="flex justify-end space-x-2">
            <x-filament-panels::form.actions :actions="$this->getFormActions()" />
        </div>
        {{ $this->form }}
        <x-filament-panels::form.actions :actions="$this->getFormActions()" />
    </x-filament-panels::form>
</x-filament-panels::page>
