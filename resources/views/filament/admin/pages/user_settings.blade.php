<x-filament-panels::page>
        <div x-data="{ tab: 'general' }">
            <x-filament::tabs label="Content tabs">
                <x-filament::tabs.item @click="tab = 'general'" :alpine-active="'tab === \'general\''">
                    General
                </x-filament::tabs.item>

                <x-filament::tabs.item @click="tab = 'api_settings'" :alpine-active="'tab === \'api_settings\''">
                    Api settings
                </x-filament::tabs.item>

            </x-filament::tabs>

            {{-- Display Events Resource Table --}}

            <div class="mt-2">
                <div x-show="tab === 'general'">
                    <x-filament-panels::form wire:submit.prevent="editPasswordAction">
                        {{ $this->editPasswordForm }}
                        <div class="col-4">
                            <x-filament::button type="submit">
                                Change
                            </x-filament::button>
                        </div>
                    </x-filament-panels::form>
                </div>
                <div x-show="tab === 'api_settings'">
                    <x-filament-panels::form wire:submit.prevent="save">
                        <div class="col-2">
                            <x-filament::button type="submit">
                                Create new
                            </x-filament::button>
                        </div>
                        <x-filament::button x-on:click="$dispatch('open-modal', {id: 'custom'})">Open</x-filament::button>
                        {{ $this->table }}
                    </x-filament-panels::form>
                </div>
            </div>
        </div>
        {{-- Display Events Role Resource Table --}}
    <x-filament::modal id="custom">
        <x-slot name="header">
            Custom modal:
        </x-slot>
        <x-filament-panels::form wire:submit.prevent="editPasswordAction">
            {{ $this->editPasswordForm }}
            <div class="col-4">
                <x-filament::button type="submit">
                    Change
                </x-filament::button>
            </div>
        </x-filament-panels::form>
    </x-filament::modal>
</x-filament-panels::page>
