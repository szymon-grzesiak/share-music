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
                    <a
                        title="Dodaj piosenkę"
                        href="{{ route('albums.create') }}"
                        class="buttonStyle flex justify-center items-center text-3xl rounded-full fixed bottom-0 right-0 mr-2 mb-6 w-12 h-12" >
                        +
                    </a>
                @endcan
                <livewire:albums.albums-grid-view />
            </div>
        </div>
    </div>
</x-app-layout>
