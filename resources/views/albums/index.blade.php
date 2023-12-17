<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('translation.navigation.albums') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" sm:rounded-lg p-4" id="table-view-wrapper">
                @can('create', App\Models\Album::class)
                    <x-wireui-button primary
                                     label="+"
                                     title="Dodaj album"
                                     href="{{ route('albums.create') }}"
                                     class="justify-self-end text-3xl bg-blue-300 hover:bg-blue-500 rounded-full fixed bottom-0 left-0 ml-10 mb-6 w-14 h-14" />
                @endcan
                <livewire:albums.albums-grid-view />
            </div>
        </div>
    </div>
</x-app-layout>
