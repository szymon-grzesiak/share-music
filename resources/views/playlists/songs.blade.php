<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{$playlist->name}}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="sm:rounded-lg table-view-wrapper">
                <livewire:playlists.specific-playlist-table-view :playlist-id="$playlist->id" />
            </div>
        </div>
    </div>
</x-app-layout>

