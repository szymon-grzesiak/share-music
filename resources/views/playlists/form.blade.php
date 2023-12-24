<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('translation.navigation.songs') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white/70 shadow-xl sm:rounded-lg p-4">
                @if (isset($playlist))
                    <livewire:playlists.playlist-form :playlist="$playlist" :editMode="true" />
                @else
                    <livewire:playlists.playlist-form :editMode="false" />
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

