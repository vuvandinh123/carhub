<x-filament-panels::page>
    <form wire:submit.prevent="save">
        {{ $this->form }}
        <div class="mt-4">
            <x-filament::button type="submit">
                Lưu thay đổi
            </x-filament::button>
        </div>
    </form>
</x-filament-panels::page>
