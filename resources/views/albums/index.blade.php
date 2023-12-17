<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('translation.navigation.albums') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" sm:rounded-lg p-4" id="table-view-wrapper">
                <livewire:albums.albums-grid-view />
            </div>
        </div>
    </div>
</x-app-layout>
